<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Translation\MessageCatalogue;
use Symfony\Component\Translation\Catalogue\MergeOperation;

class DefaultController extends AbstractController
{
    /**
     * @Route("/admin")
     */
    public function indexAction(Request $request)
    {
        $prefix = '';
        $locale = $request->get('locale') ? $request->get('locale') : 'fr';
        $output = $request->get('output') ? $request->get('output') : 'xlf';
        $bundle = $request->get('bundle') ? $request->get('bundle') : '';

        $kernel = $this->get('kernel');
        $transPaths = [$kernel->getRootDir().'/Resources/'];
        $bundles = array_keys($kernel->getBundles());

        $extractor = $this->get('translation.extractor');
        $extractor->setPrefix($prefix);
        $writer = $this->get('translation.writer');
        $loader = $this->get('translation.loader');

        // Override with provided Bundle info
        if ($bundle) {
            $foundBundle = $kernel->getBundle($bundle);
            $transPaths = [
                $foundBundle->getPath().'/Resources/',
                sprintf('%s/Resources/%s/', $kernel->getRootDir(), $foundBundle->getName()),
            ];
            dump($foundBundle->getPath().'/Resources/', sprintf('%s/Resources/%s/', $kernel->getRootDir(), $foundBundle->getName()));
        }

        // load any existing messages from the translation files
        $currentCatalogue = new MessageCatalogue($locale);

        foreach ($transPaths as $path) {
            $path .= 'translations';

            if (is_dir($path)) {
                $loader->loadMessages($path, $currentCatalogue);
            }
        }

        if ($request->isMethod('post') && count($request->get('translations'))) {
            $translations = $request->get('translations');
            $extractedCatalogue = new MessageCatalogue($locale);

            foreach ($translations as $domain => $msg) {
                if ($msg) {
                    $currentCatalogue->add($msg, $domain);
                }
            }

            $operation = new MergeOperation($currentCatalogue, $extractedCatalogue);

            if (count($operation->getDomains())) {
                $bundleTransPath = false;

                foreach ($transPaths as $path) {
                    $path .= 'translations';

                    if (is_dir($path)) {
                        $bundleTransPath = $path;
                    }
                }

                if (!$bundleTransPath) {
                    $bundleTransPath = end($transPaths).'translations';
                }


                $writer->writeTranslations(
                    $operation->getResult(),
                    $output,
                    [
                        'path'           => $bundleTransPath,
                        'default_locale' => $this->getParameter('kernel.default_locale'),
                    ]
                );
            }
        }

        $extractedCatalogue = new MessageCatalogue($locale);

        foreach ($transPaths as $path) {
            $path .= 'views';

            if (is_dir($path)) {
                $extractor->extract($path, $extractedCatalogue);
            }
        }

        $operation = new MergeOperation($currentCatalogue, $extractedCatalogue);
        $messages = $operation->getResult()->all();

        return $this->render('AppBundle::admin.html.twig', [
            'messages' => $messages,
            'bundles' => $bundles,
            'bundle' => $bundle,
            'locale' => $locale,
            'output' => $output,
            ]
        );
    }
}
