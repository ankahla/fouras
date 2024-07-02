<?php

namespace Infrastructure\Controller\Admin;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Translation\Extractor\ExtractorInterface;
use Symfony\Component\Translation\MessageCatalogue;
use Symfony\Component\Translation\Reader\TranslationReaderInterface;
use Symfony\Component\Translation\Writer\TranslationWriterInterface;

class TranslationAdminController extends AbstractController
{
    /**
     * @param Request $request
     * @param ExtractorInterface $extractor
     * @param TranslationWriterInterface $writer
     * @param TranslationReaderInterface $reader
     * @param string $projectDir
     * @return \Symfony\Component\HttpFoundation\Response
     */
    #[Route(path: '/admin/translation', name: 'admin_translation')]
    public function indexAction(
        Request $request,
        ExtractorInterface $extractor,
        TranslationWriterInterface $writer,
        TranslationReaderInterface $reader,
        string $projectDir
    ) {
        $locale = $request->get('_locale', 'fr');
        $output = $request->get('output', 'yml');

        // load any existing messages from the translation files
        $currentCatalogue = new MessageCatalogue($locale);
        $translationFiles = [sprintf('%s/translations/', $projectDir)];

        foreach ($translationFiles as $translationFile) {
            $reader->read($translationFile, $currentCatalogue);
        }

        if ($request->isMethod('post') && count($request->get('translations'))) {
            $translations = $request->get('translations');

            foreach ($translations as $d => $msg) {
                if ($msg) {
                    $currentCatalogue->add($msg, $d);
                }
            }

            $writer->write(
                $currentCatalogue,
                $output,
                [
                    'path'           => $projectDir.'/translations',
                    'default_locale' => $this->getParameter('kernel.default_locale'),
                ]
            );
        }
        // extract translatable words from templates
        $extractedCatalogue = new MessageCatalogue($locale);
        $extractor->setPrefix('');
        $extractor->extract($projectDir.'/src', $extractedCatalogue);
        $extractor->extract($projectDir.'/templates', $extractedCatalogue);
        $extractedCatalogue->addCatalogue($currentCatalogue);
        $messages = $extractedCatalogue->all();

        return $this->render(
            'admin/translation/admin.html.twig',
            [
                'messages' => $messages,
                'locale' => $locale,
                'output' => $output,
            ]
        );
    }
}
