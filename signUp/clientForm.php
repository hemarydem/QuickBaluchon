
<?php
echo' <div class="row ">
            <div class="col-md-4" style="background-color: white" >
                <div class="col-md-2 col-md-offset-5">
                    <label>NOM</label>
                    <input type="text" oninput="checkLen(\'name\',50)" placeholder="name" id="name">
                    <p id="limitname">50/50</p><p id="erroname"></p>
                </div>
                <div class="col-md-2 col-md-offset-5">
                    <label>Prénom</label>
                    <input type="text" oninput="checkLen(\'firstname\',50)"  placeholder="firstname" id="firstname">
                    <p id="limitfirstname">50/50</p><p id="errofirstname"></p>
                </div>
            </div>
            <div class="col-md-4" style="background-color: white">
                <div class="col-md-2 col-md-offset-5">
                    <label>passwords</label>
                    <input type="text" oninput="checkLen(\'pssword\',255)" value="azerty" placeholder="password" id="pssword">
                    <p id="limitpssword">255/255</p><p id="erropssword"></p>
                </div>
                <div class="col-md-2 col-md-offset-5">
                    <label>confirmPassword</label>
                    <input type="text" oninput="checkLen(\'confiamtionPword\',255)" value="azerty" placeholder="confirme password" id="confiamtionPword">
                    <p id="limitconfiamtionPword">255/255</p><p id="erroconfiamtionPword"></p>
                </div>
            </div>
            <div class="col-md-4" style="background-color: white">
                <div class="col-md-2 col-md-offset-5">
                    <label>adresse</label>
                    <input type="text" oninput="checkLen(\'address\',255)" placeholder="address" id="address">
                    <p id="limitaddress">255/255</p><p id="erroaddress"></p>
                </div>
                <div class="col-md-2 col-md-offset-5">
                    <label>numSiret</label>
                    <input type="text" oninput="checkLen(\'numSiret\',50)" placeholder="numSiret" id="numSiret">
                    <p id="limitnumSiret">50/50</p><p id="erronumSiret"></p>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-md-4" style="background-color: white">
                <div class="col-md-2 col-md-offset-5">
                        <label>mail</label>
                        <input type="mail" oninput="checkLen(\'mail\',255)"  placeholder="mail" id="mail">
                        <p id="limitmail">255/255</p><p id="erromail"></p>
                    </div>
                </div>
            <div class="col-md-4" style="background-color: white">
                <div class="col-md-2 col-md-offset-5">
                    <label for="status">profil:</label>
                    <select id="statut">
                        <option value="3">client</option>
                        <option value="1">conducteur</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4" style="background-color: white">
                <div class="col-md-2 col-md-offset-5">
                        <label>téléphone</label>
                        <input type="text" oninput="checkLen(\'tel\',10)" placeholder="telephon number" id="tel">
                        <p id="limittel">10/10</p><p id="errotel"></p>
                    </div>
                </div>
            </div>
        </div>
        ';

?>