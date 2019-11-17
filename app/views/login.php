<div align="center">
    <?php foreach ($errorsAtPage as $error){
      echo $error.'<br/>';
    }
    ?>
</div>

<div align="center">
    <h3>Login page</h3>
    <form method="post">
    <p>Email: <input type="text" name="email" value="<?php if (!empty($oldDataAtPage['email'])){echo $oldDataAtPage['email'];}?>" /></p>
    <p>Password: <input type="password" name="password" /></p>
    <input type="submit" name="submit" value="Submit" />
    </form>
    <a href="/test/register">Register new account</a>
</div>