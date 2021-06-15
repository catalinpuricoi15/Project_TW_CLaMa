<div class="main-box ">

    <div class="page-aligned">

        <h3 class="page-center-title"> Requests : </h3>

        <?php foreach ($requests as $request): ?>
            <div id="req1" class="request">
                <span class="request-txt"> <?php echo $request->getStudent()->username ?> </span>
                <button type="button" class="request-decline-btn"
                        onclick="respondToRequest(<?php echo $request->id ?>, false)">Respinge
                </button>
                <button type="button" class="request-accept-btn" onclick="respondToRequest(<?php echo $request->id ?>, true)">
                    Accepta
                </button>
            </div>
        <?php endforeach; ?>

    </div>

</div>

<script src="/js/requests.js"></script>

