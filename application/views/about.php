<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container-fluid">
    <div class="row content">
        <div class="col-sm-3 sidenav">
            <p data-img-name="children-p_min.jpg"></p>
        </div>

        <div class="col-sm-9">

            <h1><?php echo lang("msg_aboutkidsa"); ?></h1>

            <p><?php echo lang("msg_abouttext1"); ?></p>

            <p><?php echo lang("msg_abouttext2"); ?></p>
            <br>
            <br>

            <blockquote class="blockquote-reverse">
                <p class="mb-0">
                    “Grown-ups never understand anything by themselves, and it is tiresome for children to be always
                    and forever explaining things to them.”</p>
                <footer class="blockquote-footer"> Antoine de Saint-Exupéry, The Little Prince</footer>
            </blockquote>

            <strong><?php echo lang("msg_aboutlocation"); ?></strong>
            <div id="googleMap"></div>
        </div>
    </div>
</div>

<div class="container">
<?php
$private_key = openssl_pkey_get_private(
"-----BEGIN RSA PRIVATE KEY-----
MIIEowIBAAKCAQEAw44ULf8tQJsCTpBy+V1zW9Ijahp1MAQZZ/4w+pN7Hw/cgswE
n01hOucx/bTQVVpKhEVik1Ux3IKFhNbYRlKSZIX504oaN9Ep0VAJ1AgYVqG0IRt+
IleJDjZt+9yH4GZnOG57aM8+1uLSsQma0hPxcCrL36oK/O9THklRWaxRLO2hIyDG
9oOMh/KtIkEd3BqpINNrV6DZqMmQ/tcKT+MdnxNz3qTVJ0Crx1I+UlyUU0AQPR2A
pZBF7piiEqpBQwXDWBLWRCcEwycTxN6p0IERA8yQsyUHQQ0LD4n6HoCZ1UlCoHrW
QsTqXsVKyUsTKdxAiZK9mhzJnHUiQSTnszwEawIDAQABAoIBAAzCVGa744P3mSrv
GdFTW5d+GnltyH+dhNrYJvHydXINYuHV1ede8R0awJRBG+a1wW7n6Aqc4Gf2zCdi
rTHJaWvNogM/W36Q0x2pDzsaXBwq6MnQNWagN30J6BsqxGLLy6hO7RZlj0AOBJkw
ez2Bt5sN78dkHNtr8gxj1D75k0JPEaXQVCvviVAXKjz4+RRCRaN78lfqs7J+fQqO
sxbBvFrINGDZkW7E7oA+6o5t9vuo43ZuOx/ezJf1QNVD8nMX9wVcowkhHbsScT+0
3WS5pD1fTuovHZkeUcWz9p9/vbsNy+WndnC6TFHHNpLLr4O3IYOgFc/fk5I7ZiHe
CKl5LaECgYEA4PlW2mJ26t+5fpUrYcEv/X+UQccZIlRJqQrDa5Lh4/KMggcRzsJq
q6qsx/Rhrr5uBnsHdDYFZg5kai+JzdDjXdUj2W9vFCPIcaTTIyIP6rgNlRjX9fsc
Z09GtYM6556IHy1IxrfQcsmLT1yqUf4VdGHeFUqSbDpzumCtDsybHw0CgYEA3oYb
tMO4+sO8CS9B6kATBz581nl6VB2HW47LMyBWiDDsiGjR3twxZ36/KHTwRnjPN4ny
g1Rd00IKBezmCS0FSxbzRj6O0Xq4LZxyMg0XxGi/7G0ocM9nfHnAu+XY5n3oPGNt
r0MRYYvqNyxQJvv2YS8IoKZjH7qsXrNvywpwk1cCgYEAmOR7RUFjpe3Tx5Yi/HVp
YvNgU2+2wiDcSpi5BJO3Fs5Q9VFOpeB01CPS9rU76aEbbyYPg8fu1VP0pEGYepp6
2tsuWOglal+DKtCkeRz+Cjt5Z5mRs2cr/33eBR+hWaXgxqdk7UAg1tHn7lCAo+Z0
uDqGzpt2dT0oR0LKeeNNjMUCgYA/KT2v/2X/95Ll4H4LKYi9I6V3kx9/xKno+Q0A
RAuLuKdKyMXZRhLX14gWyapxtlTK5OLrGAVRs4r4x5c7v4WjHK6Mn7EWEIk6mQ9o
2YKHg1wGla1G5/ftwvlL3B/GvLIwgeBeQOEsGPSwGGnfxuDWEO2X++Ji3S+T6cav
kRUHHQKBgFR+diFLKXvyR+os7N4sAVKMeuHmITI48GplUruFgH+SE39zP71/TP4q
3Qvp8L2OVicH3+VumyVbx9fkX24w9dNb5NUOxh5YqT5MN8t7q++//avJRbcv/R48
pbeXKj3GkEhcLJyGFzZgZoaHlN+mj7LdbWlQwy+3DFxGJM1/sneX
-----END RSA PRIVATE KEY-----");

function getDatetimeNow() {
    $dt = new DateTime("now", new DateTimeZone('Europe/Helsinki'));
    return $dt->format('Y-m-d\TH:i:s\+0300');
        
}
$fields = array(
    "VK_SERVICE"     => "1011",
    "VK_VERSION"     => "008",
    "VK_SND_ID"      => "uid100010",
    "VK_STAMP"       => "12345",
    "VK_AMOUNT"      => "10",
    "VK_CURR"        => "EUR",
    "VK_ACC"         => "EE871600161234567892",
    "VK_NAME"        => "Kidsa OÜ",
    "VK_REF"         => "1234561",
    "VK_LANG"        => "EST",
    "VK_MSG"         => "Annetus Kidsale",
    "VK_RETURN"      => site_url("about/received"),
    "VK_CANCEL"      => site_url("about/cancelled"),
     "VK_DATETIME"    => getDatetimeNow(), 
    "VK_ENCODING"    => "utf-8",
);
$data = str_pad (mb_strlen($fields["VK_SERVICE"], "UTF-8"), 3, "0", STR_PAD_LEFT) . $fields["VK_SERVICE"] .   
        str_pad (mb_strlen($fields["VK_VERSION"], "UTF-8"), 3, "0", STR_PAD_LEFT) . $fields["VK_VERSION"] .    
        str_pad (mb_strlen($fields["VK_SND_ID"], "UTF-8"),  3, "0", STR_PAD_LEFT) . $fields["VK_SND_ID"] .     
        str_pad (mb_strlen($fields["VK_STAMP"], "UTF-8"),   3, "0", STR_PAD_LEFT) . $fields["VK_STAMP"] .      
        str_pad (mb_strlen($fields["VK_AMOUNT"], "UTF-8"),  3, "0", STR_PAD_LEFT) . $fields["VK_AMOUNT"] .     
        str_pad (mb_strlen($fields["VK_CURR"], "UTF-8"),    3, "0", STR_PAD_LEFT) . $fields["VK_CURR"] .       
        str_pad (mb_strlen($fields["VK_ACC"], "UTF-8"),     3, "0", STR_PAD_LEFT) . $fields["VK_ACC"] .        
        str_pad (mb_strlen($fields["VK_NAME"], "UTF-8"),    3, "0", STR_PAD_LEFT) . $fields["VK_NAME"] .       
        str_pad (mb_strlen($fields["VK_REF"], "UTF-8"),     3, "0", STR_PAD_LEFT) . $fields["VK_REF"] .        
        str_pad (mb_strlen($fields["VK_MSG"], "UTF-8"),     3, "0", STR_PAD_LEFT) . $fields["VK_MSG"] .        
        str_pad (mb_strlen($fields["VK_RETURN"], "UTF-8"),  3, "0", STR_PAD_LEFT) . $fields["VK_RETURN"] .     
        str_pad (mb_strlen($fields["VK_CANCEL"], "UTF-8"),  3, "0", STR_PAD_LEFT) . $fields["VK_CANCEL"] .     
        str_pad (mb_strlen($fields["VK_DATETIME"], "UTF-8"), 3, "0", STR_PAD_LEFT) . $fields["VK_DATETIME"];

openssl_sign ($data, $signature, $private_key, OPENSSL_ALGO_SHA1);

$fields["VK_MAC"] = base64_encode($signature);

?>
    <div class="row">
        
        <form class="form-horizontal" action="http://localhost:8080/banklink/ipizza" method="post">
            <?php
                foreach ($fields as $f => $v) {
                    echo '<input type="hidden" name="' . $f . '" value="' . htmlspecialchars ($v) . '" />' . "\n";
                }
            ?>
            <fieldset>
            
                <legend><?php echo lang("msg_supportus"); ?></legend>
                <div id="nameHolder" class="form-group">
                    <label class="col-md-4 control-label" for="PANGALINK_NAME"><?php echo lang("msg_payname"); ?></label>
                    <div class="col-md-4">
                        <input id="PANGALINK_NAME" name="PANGALINK_NAME" type="text" placeholder="<?php echo lang("msg_enterpayname"); ?>"
                            class="form-control input-md" required="">
                    </div>
                </div>
                <div id="accountHolder" class="form-group">
                    <label class="col-md-4 control-label" for="PANGALINK_ACCOUNT"><?php echo lang("msg_payaccount"); ?></label>
                    <div class="col-md-4">
                        <input id="PANGALINK_ACCOUNT" name="PANGALINK_ACCOUNT" type="text" placeholder="<?php echo lang("msg_enterpayaccount"); ?>"
                            class="form-control input-md" required="">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label" for="donatebutton"></label>
                    <div class="col-md-4">
                        <button id="donatebutton" name="donatebutton" type="submit" class="btn btn-default"><?php echo lang("msg_donate"); ?>
                        </button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>

