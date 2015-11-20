<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2015-11-18
 * Time: 2:31 PM
 */
?>
<?php
if (isset($_GET['error'])) {
    echo '<h2 style="color: red">Your account could not be created. Your username may already exist.</h2>';
    echo "<a href='" . URL . "register/page/1'>Click here to verify your username</a>";
} ?>
<h1>Your information:</h1>
<table>
    <tr>
        <th>Username:</th>
        <td>
            <?php if (isset($this->newUser['username'])) {
                echo $this->newUser['username'];
            } ?>
        </td>
    </tr>
    <tr>
        <th>Name:</th>
        <td>
            <?php if (isset($this->newUser['first_name']) && isset($this->newUser['last_name'])) {
                echo $this->newUser['first_name'] . ' ' . $this->newUser['last_name'];
            } ?>
        </td>
    </tr>
    <tr>
        <th>Email:</th>
        <td>
            <?php if (isset($this->newUser['email'])) {
                echo $this->newUser['email'];
            } ?>
        </td>
    </tr>
    <tr>
        <th>Gender:</th>
        <td>
            <?php if (isset($this->gender)) {
                echo $this->gender;
            } ?>
        </td>
    </tr>
    <tr>
        <th>Date of birth:</th>
        <td>
            <?php if (isset($this->newUser['date_of_birth'])) {
                echo $this->newUser['date_of_birth'];
            } ?>
        </td>
    </tr>
    <tr>
        <th>Phone number:</th>
        <td>
            <?php if (isset($this->newUser['phone'])) {
                echo $this->newUser['phone'];
            } ?>
        </td>
    </tr>
    <tr>
        <th>Address:</th>
        <td>
            <?php if (isset($this->newUser['address'])) {
                echo $this->newUser['address'];
            } ?>
        </td>
    </tr>
    <tr>
        <th>City:</th>
        <td>
            <?php if (isset($this->newUser['city'])) {
                echo $this->newUser['city'];
            } ?>
        </td>
    </tr>
    <tr>
        <th>Province:</th>
        <td>
            <?php if (isset($this->newUser['province'])) {
                echo $this->newUser['province'];
            } ?>
        </td>
    </tr>
    <tr>
        <th>Country:</th>
        <td>
            <?php if (isset($this->country)) {
                echo $this->country;
            } ?>
        </td>
    </tr>
</table>
<input type=button value="Modify Login Information"
       onclick="location.href='<?= URL . 'register/page/1' ?>'"/>
<input type=button value="Modify Personal Information"
       onclick="location.href='<?= URL . 'register/page/2' ?>'"/>
<input type=button value="Modify Address Information"
       onclick="location.href='<?= URL . 'register/page/3' ?>'"/>
<hr/>
<h1>Terms and Conditions</h1>
<div>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed
        malesuada condimentum libero nec pellentesque. Maecenas iaculis felis
        libero, ut tincidunt eros iaculis ut. Integer eget nulla non justo
        suscipit efficitur. Suspendisse tincidunt risus auctor dolor pulvinar
        gravida. Maecenas pellentesque, urna eget scelerisque aliquet, turpis
        nisi convallis diam, a semper nunc nunc at ex. Nullam purus augue,
        accumsan ac porta et, tempor sit amet ligula. Proin condimentum quam
        id lectus faucibus, id elementum dui rhoncus. Vestibulum hendrerit non
        arcu sit amet venenatis. Morbi fringilla sapien et ornare maximus.
        Etiam ut commodo tortor, at efficitur lacus. Praesent facilisis
        lacinia lacus eget imperdiet.</p>

    <p>Maecenas dictum in augue in bibendum. Ut et condimentum neque.
        Suspendisse quis dignissim mauris. Maecenas at est urna. Donec ex
        erat, hendrerit vitae tellus sit amet, mattis sollicitudin sem. Aenean
        ut ornare sem. Duis blandit vel leo vel ultrices. Sed dictum posuere
        tortor, quis vestibulum ante ornare et. Aenean ac mi aliquet, euismod
        mi vitae, semper erat. In fringilla facilisis fermentum.</p>

    <p>Ut tincidunt risus non magna porta, et pulvinar dui ornare.
        Proin auctor lacus ac auctor eleifend. Vestibulum viverra vehicula
        tellus finibus egestas. Duis quis arcu tristique sapien suscipit
        congue at ac ipsum. Nam maximus eget ex ac fermentum. Phasellus
        euismod, dolor vel faucibus ultrices, felis leo ornare metus, vel
        mattis tellus sapien a orci. Integer in posuere lorem, eget volutpat
        elit. Vivamus id purus vel ex hendrerit dictum. Phasellus pharetra
        velit ac augue convallis, vel tincidunt eros tincidunt. Curabitur ac
        quam at dolor suscipit lacinia. Duis blandit sed ante vel suscipit.
        Aliquam fringilla libero dui, in vehicula augue pharetra id. Donec
        vehicula ac velit vel interdum.</p>

    <p>Etiam enim metus, finibus eu magna ut, malesuada volutpat
        lectus. Integer fermentum turpis id nibh interdum fringilla. Duis eget
        orci sit amet dui interdum tristique. Mauris sed lectus aliquet,
        ullamcorper eros vitae, tincidunt quam. Aenean nisi nunc, pulvinar eu
        rutrum in, eleifend ut turpis. Aliquam molestie velit diam, in
        pharetra turpis dictum et. Nulla dapibus sodales nulla varius
        pellentesque. Donec mattis leo in lorem iaculis, id accumsan nisi
        auctor. Phasellus mattis metus nec tellus dictum, et aliquet ex
        tristique. Integer semper aliquet turpis, at sollicitudin mauris
        molestie sit amet.</p>

    <p>Integer a venenatis augue. Nulla facilisi. Sed volutpat sem
        lorem, non aliquet nisi interdum id. Nam volutpat varius porta.
        Maecenas bibendum ipsum purus, sed lobortis lacus rutrum quis.
        Curabitur in blandit est, vitae consectetur arcu. Nulla eu diam
        sapien.
</div>
<form action='<?= URL . 'register/addUser' ?>' method=POST
      style="width: 400px; margin-left: auto; margin-right: auto;">
    <table style="width: 300px;">
        <tr>
            <th>
                <label style="font-weight: bold;" for=accept>I accept all of the above Terms and
                    Conditions</label>
            </th>
            <td>
                <input type="checkbox" name=accept id=accept required
                       title="You must accept the terms and conditions"/>
            </td>
        </tr>
        <?php
        if ($this->canSubmit) {
            ?>
            <tr>
                <td colspan=2>
                    <input type="submit" name="submitOK" value="Register"  id="submitOK"  class="btn btn-primary btn-lg" >
                </td>
            </tr>
            <?php
        } else {
        ?>
        <tr>
            <td colspan=2 style="color: red; font-weight: bold; font-size: 18px;">
                <br/> Your information is incomplete, or invalid. Please review
                your information, and modify your entries using the navigation
                buttons above. Once complete, click the continue button to return to
                this page.
            </td>
            <?php
            }
            ?>

    </table>
</form>

