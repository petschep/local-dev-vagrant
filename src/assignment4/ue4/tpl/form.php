<form>
    <fieldset>
        <label for="arrival" class="<?php echo array_key_exists('arrival', $errors) ? 'error' : '' ?>">Arrival</label>
        <input type="text" name="arrival" value="<?php echo $data['arrival']; ?>">
        <?php echo array_key_exists('arrival', $errors) ? '<b>' . $errors['arrival'] . '</b>' : '' ?>
        </br>
        <label for="nights" class="<?php echo array_key_exists('nights', $errors) ? 'error' : '' ?>">Nights</label>
        <select name="nights">
            <?php
                for($i = 0; $i<=30; $i++){
                    echo '<option ' . ($i == $data["nights"] ? "selected" : "") . ' value=' . $i . '>' . $i . '</option>';
                }
            ?>
        </select>
        <?php echo array_key_exists('nights', $errors) ? '<b>' . $errors['nights'] . '</b>' : '' ?></br>
        <label for="name" class="<?php echo array_key_exists('name', $errors) ? 'error' : '' ?>">Name</label>
        <input type="text" name="name" value="<?php echo $data['name']; ?>"/>
        <?php echo array_key_exists('name', $errors) ? '<b>' . $errors['name'] . '</b>' : '' ?></br>
        <label for="email" class="<?php echo array_key_exists('email', $errors) ? 'error' : '' ?>">Email</label>
        <input type="email" name="email" value="<?php echo $data['email']; ?>">
        <?php echo array_key_exists('email', $errors) ? '<b>' . $errors['email'] . '</b>' : '' ?><br>
        <input type="hidden" name="submit" value="1">
        <input type="submit">
    </fieldset>
</form>
