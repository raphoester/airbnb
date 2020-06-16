<form action="" method="post">
    <input type="submit" value="Send details to embassy" />
    <input type="hidden" name="button_pressed" value="1" />
</form>
              <?php
              if(isset($_POST['button_pressed']))
              {
                  $to      = 'luka.mangano@ynov.com';
                  $subject = 'the subject';
                  $message = 'hello';
                  $headers = 'From: lukamang@hotmail.fr';
              
                  mail($to, $subject, $message, $headers);
              
                  echo 'Email Sent.';
              }
              ?>