<a href="<?php echo $user->html_url; ?>">
    <div class="user">
        <div class="user-data">

            <?php echo  $user->login ; ?><br>
            <?php echo$user->contributions. " contributions." ?>
            </div>

    <img src="<?php echo $user->avatar_url;?>">
    </div>
</a>




<!-- $buffer = $buffer.$user->login;
        $buffer = $buffer."<br>";
        $buffer = $buffer.'<img src="'.$user->avatar_url.'">';
        $buffer = $buffer."<br>";
        $buffer = $buffer.$user->contributions. " contributions.";
        $buffer = $buffer."<hr>";
    ;
    return $buffer; -->