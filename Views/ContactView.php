<?php
// My view for the contact page
/**
 * Created by PhpStorm.
 * User: kai-w
 * Date: 07/04/17
 * Time: 14:56
 */
?>
<h1>Contact</h1>

<div class="row">
<!--    A simple form that gets stored in the database -->
    <div class="col-md-8">
        <div class="alert alert-danger cm hidden" role="alert"><strong>Error! </strong>Invalid data entered.</div>
        <div class="alert alert-success cm hidden" role="alert"><strong>Success! </strong>Message sent successfully.</div>
        <form action="index.php?page=contact" method="post" id="cm-form">
            <div class="form-group">
                <label for="cm-name">Name</label>
                <input class="form-control" type="text" name="cm-name" id="cm-name" placeholder="Name" minlength="2" required>
            </div>
            <div class="form-group">
                <label for="cm-email">Email</label>
                <input class="form-control" type="email" name="cm-email" id="cm-email" placeholder="Email" required>
            </div>
            <div class="form-group">
                <label for="cm-message">Message</label>
                <textarea class="form-control" name="cm-message" id="cm-message" rows="12" placeholder="Message"></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-default" id="cm-send">Send</button>
            </div>
        </form>
    </div>
<!--    A google map is displayed here with markers that have data stored in the database -->
    <div class="col-md-4">
        <div id="contact-map" style="height: 100%; min-height: 300px"></div>
        <script type="text/javascript">getMapMarkers();</script>
    </div>
</div>
