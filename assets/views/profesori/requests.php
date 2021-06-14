
<div class="main-box ">

    <div class="page-aligned">

        <h3 class="page-center-title"> Requests : </h3>

        <?php foreach ($requests as $requeste): ?>
        <div id="req1" class="request">
            <span class="request-txt"> <?php echo $requeste->getStudent()->username ?> </span>
            <button type="button" class="request-decline-btn" onclick="respondToRequest('req1', false)"> decline
            </button>
            <button type="button" class="request-accept-btn" onclick="respondToRequest('req1', true)"> accept</button>
        </div>
        <?php endforeach; ?>

    </div>

</div>
<script src="/js/requests.js"> </script>