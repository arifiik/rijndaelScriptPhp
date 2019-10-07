  <?php
  $user = 'arif iik';
	$pass = '123456'; // ini yang akan di encrypt

	$iv = mcrypt_create_iv(
        mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC),
        MCRYPT_DEV_URANDOM
    );
    
    $encrypted = base64_encode(
        $iv .
        mcrypt_encrypt(
            MCRYPT_RIJNDAEL_128,
            hash('sha256', $user, true),
            $pass,
            MCRYPT_MODE_CBC,
            $iv
        )
    );
    
      $data = base64_decode($encrypted); // mendecode password yang di input
		    $iv = substr($data, 0, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC));

		    $decrypted = rtrim(
		        mcrypt_decrypt( // mendecrypt password yang awaalnya di encrypt
		            MCRYPT_RIJNDAEL_128,
		            hash('sha256', $username, true),
		            substr($data, mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC)),
		            MCRYPT_MODE_CBC,
		            $iv
		        ),
		        "\0"
		    );
        
    echo "Encrypt<br>";
    echo $encrypted;
    echo "<br>";
    echo "Decrypted<br>";
    echo $decrypted;
    
    ?>
