<div data-role="panel" data-display="push" id="nav">
            <ul>
                <li>QWERTY</li>
                <li>ASDFGH</li>
            </ul>

            <?php
                if (isset($_SESSION['email'])) {
                    echo'<div style="float:right;"><button id="lll" data-icon="delete" value="NO MODE"></button>
                    </div>';
                }
                ?>

                <div id="infoPers"></div>
        </div>