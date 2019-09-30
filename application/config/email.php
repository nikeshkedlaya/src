<?php defined('BASEPATH') OR exit('No direct script access allowed.');
$email = array();
$email['useragent']        = 'PHPMailer';              // Mail engine switcher: 'CodeIgniter' or 'PHPMailer'
$email['protocol']         = 'smtp';                   // 'mail', 'sendmail', or 'smtp'
$email['mailpath']         = '/usr/sbin/sendmail';
$email['smtp_host']        = 'localhost';
$email['smtp_user']        = 'support@kaholabs.com';
$email['smtp_pass']        = 'kaho2014';
$email['smtp_port']        = 465;
$email['smtp_timeout']     = 30;                       // (in seconds)
$email['smtp_crypto']      = 'ssl';                       // '' or 'tls' or 'ssl'
$email['smtp_debug']       = 0;                        // PHPMailer's SMTP debug info level: 0 = off, 1 = commands, 2 = commands and data, 3 = as 2 plus connection status, 4 = low level data output.
$email['debug_output']     = '';                       // PHPMailer's SMTP debug output: 'html', 'echo', 'error_log' or user defined function with parameter $str and $level. NULL or '' means 'echo' on CLI, 'html' otherwise.
$email['smtp_auto_tls']    = true;                     // Whether to enable TLS encryption automatically if a server supports it, even if `smtp_crypto` is not set to 'tls'.
$email['smtp_conn_options'] = array();                 // SMTP connection options, an array passed to the function stream_context_create() when connecting via SMTP.
$email['wordwrap']         = true;
$email['wrapchars']        = 76;
$email['mailtype']         = 'html';                   // 'text' or 'html'
$email['charset']          = null;                     // 'UTF-8', 'ISO-8859-15', ...; NULL (preferable) means config_item('charset'), i.e. the character set of the site.
$email['validate']         = true;
$email['priority']         = 3;                        // 1, 2, 3, 4, 5; on PHPMailer useragent NULL is a possible option, it means that X-priority header is not set at all, see https://github.com/PHPMailer/PHPMailer/issues/449
$email['crlf']             = "\n";                     // "\r\n" or "\n" or "\r"
$email['newline']          = "\n";                     // "\r\n" or "\n" or "\r"
$email['bcc_batch_mode']   = false;
$email['bcc_batch_size']   = 200;
$email['encoding']         = '8bit';                   // The body encoding. For CodeIgniter: '8bit' or '7bit'. For PHPMailer: '8bit', '7bit', 'binary', 'base64', or 'quoted-printable'.

// DKIM Signing
// See https://yomotherboard.com/how-to-setup-email-server-dkim-keys/
// See http://stackoverflow.com/questions/24463425/send-mail-in-phpmailer-using-dkim-keys
// See https://github.com/PHPMailer/PHPMailer/blob/v5.2.14/test/phpmailerTest.php#L1708
$email['dkim_domain']      = '';                       // DKIM signing domain name, for exmple 'example.com'.
$email['dkim_private']     = '';                       // DKIM private key, set as a file path.
$email['dkim_private_string'] = '';                    // DKIM private key, set directly from a string.
$email['dkim_selector']    = '';                       // DKIM selector.
$email['dkim_passphrase']  = '';                       // DKIM passphrase, used if your key is encrypted.
$email['dkim_identity']    = '';                       // DKIM Identity, usually the email address used as the source of the email.

$config['email'] = $email;
