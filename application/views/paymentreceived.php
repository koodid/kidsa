<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php
$public_key = openssl_pkey_get_public("-----BEGIN CERTIFICATE-----
MIIDljCCAn4CCQCLQf2mi20tQTANBgkqhkiG9w0BAQUFADCBjDELMAkGA1UEBhMC
RUUxETAPBgNVBAgTCEhhcmp1bWFhMRAwDgYDVQQHEwdUYWxsaW5uMQ0wCwYDVQQK
EwRUZXN0MREwDwYDVQQLEwhiYW5rbGluazEXMBUGA1UEAxMObG9jYWxob3N0IDgw
ODAxHTAbBgkqhkiG9w0BCQEWDnRlc3RAbG9jYWxob3N0MB4XDTE3MDQwNTEyMDQ0
MVoXDTM3MDMzMTEyMDQ0MVowgYwxCzAJBgNVBAYTAkVFMREwDwYDVQQIEwhIYXJq
dW1hYTEQMA4GA1UEBxMHVGFsbGlubjENMAsGA1UEChMEVGVzdDERMA8GA1UECxMI
YmFua2xpbmsxFzAVBgNVBAMTDmxvY2FsaG9zdCA4MDgwMR0wGwYJKoZIhvcNAQkB
Fg50ZXN0QGxvY2FsaG9zdDCCASIwDQYJKoZIhvcNAQEBBQADggEPADCCAQoCggEB
ALt0uBxKvQKCvxIk/r5OFY6VnJmzpstcv+Dwo/CrV24QoblHk3C6Cj+0/A7g3YTe
ccSgXrVIUENyjq0uoIBqmuk9FoQ8hVn6MnaOc8UaFEKa76yDc8iZTasGub30RMDU
bTGqFA228dZW65wMlCQ89eeDoWnrz/MWGvpfB2CBFJS4MIkVNIuvvB+Q0haZUcSP
hJRMiow1gDieHJikaK8AexLk2/X0OhoAFgTd3O/LsuGR8cH99NKF6Nd6OOPqPAWJ
lgw4EBEDnGt50kOdmPTEDqnc4x/7eIfPFSwgD940CO2zJYpNa3v7AEFy0ksAIYq1
C/I8rRK2oVqHYDZx0lGKRbcCAwEAATANBgkqhkiG9w0BAQUFAAOCAQEAneuW8Wgg
qd6qgieqS+FsmOVDg7l53U1iQwzM85B4dvNYXyCeUVBtbdIdMMkTAt6Hualwh/7l
mCLZIhe5WhOTIPJzKxnn97AmfRz40QqfINRSQ16urJWo9gMFk0KTVvnQp2Ht2a7t
DX0ZViz6Rj4xNQYS11ttOUGf1bOSO+7BDp0AWnUZUqZB8eK+nrw23m4gVR2IKZIY
9UIlNbkVuBvxgQpx4QD+Tu9dBbMIVPEmTGaRp91cMT6iXu6xI/q+rqAyx8Gr+sIJ
+GbsZ75/BUyvzrAugbBOjJfNoJjaQ0bXD425nFp+OGpM0FIzJ0gx0LRJvgo+Akzo
s+LAGzZpc2y/7g==
-----END CERTIFICATE-----");

$fields = array ();
foreach ((array)$_REQUEST as $f => $v) {
       if (substr ($f, 0, 3) == 'VK_') {
           $fields[$f] = $v;
       }
   }

$data = str_pad (mb_strlen($fields["VK_SERVICE"], "UTF-8"),   3, "0", STR_PAD_LEFT) . $fields["VK_SERVICE"] .    
        str_pad (mb_strlen($fields["VK_VERSION"], "UTF-8"),   3, "0", STR_PAD_LEFT) . $fields["VK_VERSION"] .   
        str_pad (mb_strlen($fields["VK_SND_ID"], "UTF-8"),    3, "0", STR_PAD_LEFT) . $fields["VK_SND_ID"] .    
        str_pad (mb_strlen($fields["VK_REC_ID"], "UTF-8"),    3, "0", STR_PAD_LEFT) . $fields["VK_REC_ID"] .    
        str_pad (mb_strlen($fields["VK_STAMP"], "UTF-8"),     3, "0", STR_PAD_LEFT) . $fields["VK_STAMP"] .      
        str_pad (mb_strlen($fields["VK_T_NO"], "UTF-8"),      3, "0", STR_PAD_LEFT) . $fields["VK_T_NO"] .      
        str_pad (mb_strlen($fields["VK_AMOUNT"], "UTF-8"),    3, "0", STR_PAD_LEFT) . $fields["VK_AMOUNT"] .    
        str_pad (mb_strlen($fields["VK_CURR"], "UTF-8"),      3, "0", STR_PAD_LEFT) . $fields["VK_CURR"] .       
        str_pad (mb_strlen($fields["VK_REC_ACC"], "UTF-8"),   3, "0", STR_PAD_LEFT) . $fields["VK_REC_ACC"] .   
        str_pad (mb_strlen($fields["VK_REC_NAME"], "UTF-8"),  3, "0", STR_PAD_LEFT) . $fields["VK_REC_NAME"] .   
        str_pad (mb_strlen($fields["VK_SND_ACC"], "UTF-8"),   3, "0", STR_PAD_LEFT) . $fields["VK_SND_ACC"] .    
        str_pad (mb_strlen($fields["VK_SND_NAME"], "UTF-8"),  3, "0", STR_PAD_LEFT) . $fields["VK_SND_NAME"] .   
        str_pad (mb_strlen($fields["VK_REF"], "UTF-8"),       3, "0", STR_PAD_LEFT) . $fields["VK_REF"] .        
        str_pad (mb_strlen($fields["VK_MSG"], "UTF-8"),       3, "0", STR_PAD_LEFT) . $fields["VK_MSG"] .        
        str_pad (mb_strlen($fields["VK_T_DATETIME"], "UTF-8"), 3, "0", STR_PAD_LEFT) . $fields["VK_T_DATETIME"]; 
if (openssl_verify ($data, base64_decode($fields["VK_MAC"]), $public_key) !== 1) {
    $signatureVerified = false;
}else{
    $signatureVerified = true;
}


?>

<?php if($fields["VK_SERVICE"] == "1111" and $signatureVerified):?>
<div class="alert alert-success">
    <strong><?php echo lang("msg_paymentsuccess"); ?></strong>
</div>
<?php endif; ?>
<?php if(! ($fields["VK_SERVICE"] == "1111") or ! $signatureVerified):?>
<div class="alert alert-success">
    <strong><?php echo lang("msg_paymentcancelled"); ?></strong>
</div>
<?php endif; ?>