<div align="center">
    <?php foreach ($errorsAtPage as $error){
        echo $error.'<br/>';
    }
    ?>
</div>

<div align="center">
    <h3>Register page</h3>
    <form method="post">
        <p>First name: <input type="text" name="firstname" value="<?php if (!empty($oldDataAtPage['firstname'])){echo $oldDataAtPage['firstname'];}?>"/></p>
        <p>Surname: <input type="text" name="surname" value="<?php if (!empty($oldDataAtPage['surname'])){echo $oldDataAtPage['surname'];}?>"/></p>
        <p>Email: <input type="text" name="email" value="<?php if (!empty($oldDataAtPage['email'])){echo $oldDataAtPage['email'];}?>"/></p>
        <p>Gender: <select name="gender">
                <option value="null">Choose gender</option>
                <option value="male" <?php if (!empty($oldDataAtPage['gender']) && $oldDataAtPage['gender'] == 'male'){echo 'selected';}?>>Male</option>
                <option value="female" <?php if (!empty($oldDataAtPage['gender']) && $oldDataAtPage['gender'] == 'female'){echo 'selected';}?>>Female</option>
            </select></p>
        <p>Password: <input type="password" name="password" /></p>
        <p>Confirm password: <input type="password" name="passwordConfirmation" /></p>
        <input type="submit" name="submit" value="Submit" />
    </form>
</div>
