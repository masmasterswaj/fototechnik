﻿<!-- ARTYKUL {index} ---------------------------------------------------------------------------------------------------------------------------------->
            <div class="tresc">
            <h2><span class="tytul-szary">{tytulakt}</span></h2>
            <h5><span class="tytul-szary">Opublikowano</span> 
            <span class="tytul-pom">{data}</span> 
            <span class="tytul-szary">przez </span>
            <span class="tytul-pom">{autor}</span>
            </h5>
            <br />
<!-- BUTTONY DLA EDYCJI {index} ----------------------------------------------------------------------------------------------------------------------->
            {editButton}
            <br />
<!-- TEKST AKTUALNOSCI {index} --------------------------------------------------------------------------------------------------------------------->
            {tekstAkt}
            <br /><br />
            <div class="tresc-zdjecie" id="art{index}">
                {htmlArtPicturesOne}
                <a id="s{index}">
                    <div class="tresc-wiecej">
                    więcej<img src="{pathfile}images/strzalka.png" width="13" height="11" id="strzalka"/>
                    </div>
                </a>
<!-- OBIEKT FACEBOOK {index} ----------------------------------------------------------------------------------------------------------------------->

                <div class="fb-like" data-href="{face_dns}?art={index}" 
                data-layout="button_count" data-action="like" data-show-faces="true" data-share="true">
                </div>
                <div class="tresc-miniatury">
<!-- GALERIA ZDJEC {index} --------------------------------------------------------------------------------------------------------------------->
                    {htmlArtPicturesGalery}
                </div>
                <div class="tresc-artykul">
                {autorzdj}
<!-- TEKST ARTYKULU {index} --------------------------------------------------------------------------------------------------------------------->
                {tekstArt}
                </div>
                <div id="tresc-end">
                </div>
            </div>
            </div>