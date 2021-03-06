<?php

class JConfig
{
    public $offline = '0';
    public $offline_message = 'Ce site est en maintenance.<br /> Merci de revenir ultérieurement.';
    public $display_offline_message = '1';
    public $offline_image = '';
    public $sitename = 'Fouras blog';
    public $editor = 'tinymce';
    public $captcha = '0';
    public $list_limit = '20';
    public $access = '1';
    public $debug = '0';
    public $debug_lang = '0';
    public $dbtype = 'mysqli';
    public $host = 'localhost';
    public $user = 'root';
    public $password = '';
    public $db = 'cms';
    public $dbprefix = 'cms_';
    public $live_site = '';
    public $secret = 'BccHiFIY6S3FAZQI';
    public $gzip = '0';
    public $error_reporting = 'production';
    public $helpurl = 'https://help.joomla.fr/index.php?option=com_help&keyref=Help{major}{minor}:{keyref}';
    public $ftp_host = '';
    public $ftp_port = '';
    public $ftp_user = '';
    public $ftp_pass = '';
    public $ftp_root = '';
    public $ftp_enable = '0';
    public $offset = 'UTC';
    public $mailonline = '1';
    public $mailer = 'mail';
    public $mailfrom = 'kahla.anoir@gmail.com';
    public $fromname = 'Fouras blog';
    public $sendmail = '/usr/sbin/sendmail';
    public $smtpauth = '0';
    public $smtpuser = '';
    public $smtppass = '';
    public $smtphost = 'localhost';
    public $smtpsecure = 'none';
    public $smtpport = '25';
    public $caching = '0';
    public $cache_handler = 'file';
    public $cachetime = '15';
    public $cache_platformprefix = '0';
    public $MetaDesc = '';
    public $MetaKeys = '';
    public $MetaTitle = '1';
    public $MetaAuthor = '1';
    public $MetaVersion = '0';
    public $robots = '';
    public $sef = '1';
    public $sef_rewrite = '1';
    public $sef_suffix = '0';
    public $unicodeslugs = '0';
    public $feed_limit = '10';
    public $feed_email = 'none';
    public $log_path = '/var/www/web/cms/administrator/logs';
    public $tmp_path = '/var/www/web/cms/tmp';
    public $lifetime = '30';
    public $session_handler = 'database';
    public $shared_session = '0';
    public $memcache_persist = '1';
    public $memcache_compress = '0';
    public $memcache_server_host = 'localhost';
    public $memcache_server_port = '11211';
    public $memcached_persist = '1';
    public $memcached_compress = '0';
    public $memcached_server_host = 'localhost';
    public $memcached_server_port = '11211';
    public $redis_persist = '1';
    public $redis_server_host = 'localhost';
    public $redis_server_port = '6379';
    public $redis_server_auth = '';
    public $redis_server_db = '0';
    public $proxy_enable = '0';
    public $proxy_host = '';
    public $proxy_port = '';
    public $proxy_user = '';
    public $proxy_pass = '';
    public $massmailoff = '0';
    public $replyto = '';
    public $replytoname = '';
    public $MetaRights = '';
    public $sitename_pagetitles = '0';
    public $force_ssl = '0';
    public $session_memcache_server_host = 'localhost';
    public $session_memcache_server_port = '11211';
    public $session_memcached_server_host = 'localhost';
    public $session_memcached_server_port = '11211';
    public $session_redis_persist = '1';
    public $session_redis_server_host = 'localhost';
    public $session_redis_server_port = '6379';
    public $session_redis_server_auth = '';
    public $session_redis_server_db = '0';
    public $frontediting = '1';
    public $cookie_domain = '';
    public $cookie_path = '';
    public $asset_id = '1';

    public function __construct()
    {
        $dsn = getenv('DATABASE_CMS_URL');
        $db = parse_url($dsn);

        if ($db) {
            $this->host = $db['host'];
            $this->user = $db['user'];
            $this->password = $db['pass'];
            $this->db = ltrim($db['path'], '/');
        }

        $dsn = getenv('REDIS_URL');
        $db = parse_url($dsn);

        if ($db) {
            $this->redis_server_host = $this->session_redis_server_host = $db['host'];
            $this->redis_server_port = $this->session_redis_server_port = $db['port'];
            $this->redis_server_auth = $this->session_redis_server_auth = $db['pass'];
        }

        $this->debug = getenv('APP_DEBUG');
        //$this->error_reporting = getenv('APP_DEBUG') === 'true' ? 'development' : 'production';
        $this->log_path = __DIR__ . '/administrator/logs';
        $this->tmp_path = __DIR__ . '/tmp';
    }
}