<?php
/**
 * contact.php
 * contact form
 */

/**
 * require imageVerification class
 */
require_once("includes/imageVerification.php");

/**
 * require email verification regexp funcion
 */
require_once("includes/validateEmailFormat.php");

/**
 * create an imageVerification object
 */
$imgVer = new imageVerification;

/**
 * first see if this is being used to generate the image
 */
if (isset($_GET["image"])) {
    $imgVer->getImage();
		exit;
}

/**
 * @var string admin email address (messages to users appear to be sent from this address)
 */
$admin_email = "mail@e-2.org";

/**
 * @var string email address messages are sent to - can be a comma-separated list
 */
$email_to = "mail@e-2.org";

/**
 * @var string email template filename
 */
$email_template = dirname(__FILE__) . "/includes/email.txt";

/**
 * @var string email log (for testing)
 */
$email_log = dirname(__FILE__) . "/logs/email.log";

/**
 * @var string injection attack log
 */
$attack_log = dirname(__FILE__) . "/logs/attack.log";

/**
 * @var string email csv (for storing all completed forms)
 */
$email_csv = dirname(__FILE__) . "/logs/contacts.csv";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>e-2.org | contact</title>
<meta name="DC.Title" content="e-2.org | contact" />
<link rel="SCHEMA.dc" href="http://purl.org/metadata/dublin_core_elements#title" />
<meta name="DC.Date.X-MetadataLastModified" scheme="ISO8601" content="2006-09-02" />
<link rel="SCHEMA.dc" href="http://purl.org/metadata/dublin_core_elements#date" />
<meta name="DC.Identifier" content="http://e-2.org/contact.php" />
<link rel="SCHEMA.dc" href="http://purl.org/metadata/dublin_core_elements#identifier" />
<meta name="DC.Creator.CorporateName" content="e-2.org limited" />
<link rel="SCHEMA.dc" href="http://purl.org/metadata/dublin_core_elements#creator" />
<meta name="DC.Creator.CorporateName.Address" content="mail@e-2.org" />
<link rel="SCHEMA.dc" href="http://purl.org/metadata/dublin_core_elements#creator" />
<meta name="DC.Subject" content="art" />
<link rel="SCHEMA.dc" href="http://purl.org/metadata/dublin_core_elements#subject" />
<meta name="DC.Subject" content="new media" />
<link rel="SCHEMA.dc" href="http://purl.org/metadata/dublin_core_elements#subject" />
<meta name="DC.Subject" content="artists" />
<link rel="SCHEMA.dc" href="http://purl.org/metadata/dublin_core_elements#subject" />
<meta name="DC.Description" content="e-2 commissions and presents new works in new media with up and coming contemporary artists" />
<link rel="SCHEMA.dc" href="http://purl.org/metadata/dublin_core_elements#description" />
<meta name="DC.Contributor" content="Peter Moore" />
<link rel="SCHEMA.dc" href="http://purl.org/metadata/dublin_core_elements#contributor" />
<meta name="DC.Contributor" content="Peter Edwards" />
<link rel="SCHEMA.dc" href="http://purl.org/metadata/dublin_core_elements#contributor" />
<meta name="DC.Date" scheme="ISO8601" content="1997-01-01" />
<link rel="SCHEMA.dc" href="http://purl.org/metadata/dublin_core_elements#date" />
<meta name="DC.Type" content="Text.Homepage.Organizational" />
<link rel="SCHEMA.dc" href="http://purl.org/metadata/dublin_core_elements#type" />
<meta name="DC.Format" scheme="IMT" content="text/html" />
<link rel="SCHEMA.dc" href="http://purl.org/metadata/dublin_core_elements#format" />
<link rel="SCHEMA.imt" href="http://sunsite.auc.dk/RFC/rfc/rfc2046.html" />
<meta name="DC.Language" scheme="ISO639-1" content="en" />
<link rel="SCHEMA.dc" href="http://purl.org/metadata/dublin_core_elements#language" />
<meta name="DC.Rights" content="http://e-2.org/copyright.html" />
<link rel="SCHEMA.dc" href="http://purl.org/metadata/dublin_core_elements#rights" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
<script type="text/javascript" src="js/e-2.js"></script>
<link rel="stylesheet" href="css/e-2.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/whitegrey.css" type="text/css" media="screen" title="whitegrey" />
<link rel="alternate stylesheet" href="css/greywhite.css" type="text/css" media="screen" title="greywhite" />
<!-- fake position:fixed for the footer in IE5.5/IE6 -->
<!--[if gte IE 5.5]>
<![if lt IE 7]>
<style type="text/css">
#footer {
  position:absolute;
	top:expression((ignoreMe = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop)+(document.documentElement.clientHeight ? document.documentElement.clientHeight:document.body.clientHeight)-66);
}
</style>
<![endif]>
<![endif]-->
</head>
<body>
<div class="column-content">
  <!-- left content -->
  <div class="leftcol">
    <div class="content">
  	  <div class="left-column-content">
<?php
/**
 * process posted content
 */
$errors = array();
$values = array("fullname" => '', "email" => '', "message" => '');
if (isset($_POST["submit"])) {
    if (!isset($_POST["fullname"]) || trim($_POST["fullname"]) == '') {
        $errors["fullname"] = 'Please supply your name';
    } else {
        $values["fullname"] = htmlentities(trim($_POST["fullname"]));
    }
    if (!isset($_POST["email"]) || trim($_POST["email"]) == '') {
        $errors["email"] = 'Please supply your email address';
    } elseif (!validateEmailFormat($_POST["email"])) {
        $errors["email"] = 'The email address you supplied is invalid';
        $values["email"] = htmlentities(trim($_POST["email"]));
    } else {
        $values["email"] = htmlentities(trim($_POST["email"]));
    }
		$values["message"] = htmlentities(trim($_POST["message"]));
		//test for injection attacks
		if (preg_match('/Content-Type:(\s*)multipart\/mixed/i', $values["message"])) {
		    print('<p>Your attempt at stream injection has been logged. You will no longer be able to access this site, and your IP address will be reported.</p></div></div></div></div></body></html>');
				if ($al = fopen($attack_log, 'ab')) {
				    $msg = date("U") . "|" . $_SERVER['REMOTE_ADDR'] . "|" . $_SERVER["HTTP_USER_AGENT"] . "\n";
						fwrite($al, $msg);
						fclose($al);
				}
				if ($fh = fopen('.htaccess', 'ab')) {
				    $deny = '# ' . date("D M j G:i:s T Y") . "\n";
            $deny .= 'Deny from ' . $_SERVER['REMOTE_ADDR'] . "\n";
				    fwrite($fh, $deny);
						fclose($fh);
				}
				exit;
    }
		if (!isset($_POST["verificationCode"]) || trim($_POST["verificationCode"]) == '' || !$imgVer->verifyCode($_POST["verificationCode"])) {
		    $errors["verificationCode"] = 'The code you entered was incorrect';
		}
    $imgVer->clear();
		$values["verificationCode"] = '';
    if (count($errors)) {
	      printf('<p>Sorry, the form you just submitted contains errors. Please correct these and try again, or email <a href="mailto:%s">%s</a>.</p>', $admin_email, $admin_email);
				print(contactform($values, $errors, $imgVer));
    } else {
        $email_message = sprintf("The e-2 contact form has been submitted - message follows:\n\n=====================================\n\nName: %s\nEmail: %s\nMessage: %s\n", $values["fullname"], $values["email"], $values["message"]);
        $email_subject = "[e-2 contact form]";
        if (send_email($admin_email, $email_subject, $email_message, $admin_email)) {
		    print('<p>Thank you for completing the contact form on the e-2 website.</p>');
		} else {
		    print("Sorry, there was a problem sending your message");
		}
    }
} else {
    print(contactform($values, $errors, $imgVer));
}
?>
  		</div>
  	</div>
  </div>
  <!--right content-->
  <div class="rightcol">
    <div class="content">
  	  <div class="right-column-content">
 	      <p>e-2</p>
        <p>18 Ashwin Street<br />Hackney<br />London E8 3DL<br />United Kingdom</p>
        <p>email: <a href="mailto:mail@e-2.org">mail@e-2.org</a><br />tel:+44 7760 483 103</p>
			</div>
  	</div>
  </div>
</div>
<div id="footer-ghost">&nbsp;</div>
<div id="footer">
  <div id="footer-content">
    <!-- logo -->
    <div id="logo">
      <a href="/" class="plain">
        <img src="/images/logos/e2_160.gif" width="160" height="46" alt="e-2.org limited logo" title="click to return to the home page" />
      </a>
    </div>
    <!-- navigation -->
    <div id="c">
      <ul>
    	<li><a href="#" class="current">contact</a></li>
      </ul>
    </div>
    <div id="a">
      <ul>
    		<li><a href="/about/">about</a></li>
    	</ul>
    </div>
	</div>
</div>
</body>
</html>
<?php
/**
 * contactform
 * returns HTML for the contact form
 * @param array $errors
 * @param array $values
 * @return string HTML form
 */
function contactform($values = array(), $errors = array(), &$imgVerObj)
{
    $out = '<form action="contact.php" method="post" name="contactus" id="contactus">';
    $out .= sprintf('<p class="form"><label for="fullname">name:</label><input type="text" class="txt" maxlength="255" name="fullname" id="fullname" value="%s" /></p>', $values["fullname"]);
    if (isset($errors["fullname"])) {
        $out .= sprintf('<p class="form error">%s</p>', $errors["fullname"]);
    }
    $out .= sprintf('<p class="form"><label for="email">email:</label><input type="text" class="txt" maxlength="255" name="email" id="email" value="%s" /></p>', $values["email"]);
    if (isset($errors["email"])) {
        $out .= sprintf('<p class="form error">%s</p>', $errors["email"]);
    }
    $out .= sprintf('<p class="form"><label for="message">message:</label><textarea class="txt" cols="30" rows="5" name="message" id="message" onfocus="this.value=\'\'">%s</textarea></p>', $values["message"]);
    if (isset($errors["message"])) {
        $out .= sprintf('<p class="form error">%s</p>', $errors["message"]);
    }
    $out .= sprintf('<p class="form imgver"><img src="/contact.php?image=%s" alt="verification image" width="%d" height="%d" /></p>', md5(uniqid(rand(), true)), $imgVerObj->img_width, $imgVerObj->img_height);
		$out .= '<p class="form imgver"><label for="verificationCode">type the characters you see in the image above:</label><input type="text" class="txt" name="verificationCode" id="verificationCode" value="" /></p>';
    if (isset($errors["verificationCode"])) {
        $out .= sprintf('<p class="form error">%s</p>', $errors["verificationCode"]);		    
		}
    $out .= '<p class="form indent"><input type="submit" class="submit-button" name="submit" value="send" /></p></form>';
    return $out;
}
/**
 * send_email
 * wrapper for the PHP mail() function so emails get written to a log on windows test machine
 */
function send_email($email, $subject, $message, $admin_email) {

        /**
         * require phpMailer class
         */
        require_once("includes/phpmailer/class.phpmailer.php");
        $mail = new PHPMailer();
        $mail->IsMail();
        $mail->From = $admin_email;
        $mail->FromName = "e-2.org";
        $mail->AddAddress($email);
        $mail->AddReplyTo($admin_email, "e-2.org");
        $mail->Subject = $subject;
        $mail->Body = $message;
        return $mail->Send();
}

?>
