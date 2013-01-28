<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span2">
        <?PHP include("navigation.php"); ?>
    </div>
    <div class="span10">
        <h1>Add New Sacrifice</h1>
        

        
        <form class="form-horizontal">
            <h2>About the Sacrificer</h2>
        <div class="control-group">
          <label class="control-label" for="inputType">Type</label>
          <div class="controls">
              <select name="inputType">
                  <option>Sacrifice</option>
                  <option>Funeral</option>
                  <option>Arena</option>
                  <option>God Audience</option>
                  <option>Other</option>
              </select>
          </div>
        </div>        
    
        <div class="control-group">
          <label class="control-label" for="inputPriest">Priest</label>
          <div class="controls">
            <input type="number" class="input-mini" id="inputPID" placeholder="PID" length="4">
            <input type="text" id="inputCharacter" placeholder="Character">
          </div>
        </div>
            
        <div class="control-group">
          <label class="control-label" for="inputGroup">Group/Nation</label>
          <div class="controls">
            <input type="text" id="inputGroup" placeholder="Group">
            <input type="text" id="inputGroup" class="input-small" placeholder="Nation">
          </div>
        </div>
            
            <h2>About the Sacrifice Target</h2>
            
            
        <div class="control-group">
          <label class="control-label" for="inputDeity">Deity</label>
          <div class="controls">
            <input type="text" id="inputDeity" placeholder="Deity" 
            data-source='["CARTHAGE: Astarte", "CARTHAGE: Athtar", "CARTHAGE: Baal", "CARTHAGE: Dagon", "CARTHAGE: DEATH MESSENGER – Mot", "CARTHAGE: El", "CARTHAGE: Eshmun", "CARTHAGE: Kothar-na-Khasis", "CARTHAGE: Melqart", "CARTHAGE: Adonis", "CARTHAGE: OTHER (specify in Comments)", "CARTHAGE: Shapash", "CARTHAGE: Tanit", "CARTHAGE: Yam", "EGYPT: Anubis", "EGYPT: Apep", "EGYPT: Bast", "EGYPT: DEATH MESSENGER – Aken", "EGYPT: Geb", "EGYPT: Horus", "EGYPT: Isis", "EGYPT: Nephthys", "EGYPT: Nut", "EGYPT: Osiris", "EGYPT: OTHER (specify in Comments)", "EGYPT: Ra", "EGYPT: Sekhmet", "EGYPT: Shu", "EGYPT: Sutekh", "EGYPT: Tefnut", "EGYPT: Thoth", "GREECE: Aphrodite", "GREECE: Apollo", "GREECE: Ares", "GREECE: Artemis", "GREECE: DEATH MESSENGER – Charon", "GREECE: Demeter", "GREECE: Eris", "GREECE: Hades", "GREECE: Hecate", "GREECE: Hera", "GREECE: OTHER (specify in Comments)", "GREECE: Persephone", "GREECE: Poseidon", "GREECE: Zeus", "PERSIA (NEW): Aesma Daeva", "PERSIA (NEW): Ahura Mazda (Ohrmazd)", "PERSIA (NEW): Amitra", "PERSIA (NEW): Angra Mainyu (Ahriman)", "PERSIA (NEW): DEATH MESSENGER – Asto Vidatu", "PERSIA (NEW): Sraosha", "PERSIA (NEW): The Arch-Daevas", "PERSIA (NEW): The Bounteous Immortals", "PERSIA (OLD): Amitra", "PERSIA (OLD): Anu", "PERSIA (OLD): Pazuzu", "PERSIA (OLD): Lamashtu", "PERSIA (OLD): Azi Dahak", "PERSIA (OLD): DEATH MESSENGER – Namtar", "PERSIA (OLD): Enki", "PERSIA (OLD): Ereshkigal", "PERSIA (OLD): Ishtar", "PERSIA (OLD): Marduk", "PERSIA (OLD): Nergal", "PERSIA (OLD): Ninhursag", "PERSIA (OLD): Shamash", "PERSIA (OLD): Sin", "PERSIA (OLD): Tiamat", "PERSIA: OTHER (specify in Comments)", "ROME: Aeneas", "ROME: Cybele", "ROME: DEATH MESSENGER – Tiberinus", "ROME: Diana", "ROME: Janus", "ROME: Juno", "ROME: Jupiter", "ROME: Mars", "ROME: Mercury", "ROME: Metis", "ROME: Mithras", "ROME: Cardea", "ROME: Rhea Silvia", "ROME: Vulcan", "ROME: ", "ROME: Neptune", "ROME: OTHER (specify in Comments)", "ROME: Pluto", "ROME: Proserpina", "ROME: Remus", "ROME: Romulus", "ROME: Romulus & Remus", "HP: Athena Britomartis", "HP: Dionysos Devoured", "HP: Hephaestus Reforged", "HP: Molech", "HP: Atargatis", "HP: Adonis", "HP: The Bull Leaper", "HP: DEATH MESSENGER: Asterius", "HP: OTHER (specify in Comments)"]'  
            data-provide="typeahead" data-items="24">
          </div>
        </div>
            
            <h2>About the Sacrifice</h2>
        
        <div class="control-group">
          <label class="control-label" for="inputDrachma">Drachma</label>
          <div class="controls">
              
            <input type="number" class="input-mini" id="chalkoi" placeholder="Chlk">
            <input type="number" class="input-mini" id="drachma" placeholder="Drac">
            <input type="number" class="input-mini" id="pentadrachma" placeholder="5Drac">
            <input type="number" class="input-mini" id="Mina" placeholder="Mina">
            
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="inputDrachma">Quintessence</label>
          <div class="controls">
            
            <div class="input-prepend">
            <span class="add-on"><img src="/assets/home/img/elements/Green.png" width="22px"></span>
            <input type="number" class="input-mini" id="earth" placeholder="Earth">
            </div>
            <div class="input-prepend">
            <span class="add-on"><img src="/assets/home/img/elements/White.png" width="22px"></span>
            <input type="number" class="input-mini" id="air" placeholder="Air">
            </div>
            <div class="input-prepend">
            <span class="add-on"><img src="/assets/home/img/elements/Red.png" width="22px"></span>
            <input type="number" class="input-mini" id="fire" placeholder="Fire">
            </div>
            <div class="input-prepend">
            <span class="add-on"><img src="/assets/home/img/elements/Blue.png" width="22px"></span>
            <input type="number" class="input-mini" id="water" placeholder="Water">
            </div>
            
          </div>
        </div>
            
        <div class="control-group">
          <label class="control-label" for="inputLives">Lives</label>
          <div class="controls">
              
            <div class="input-prepend">
            <span class="add-on"><img src="/assets/home/img/heart-icon.png" width="22px"></span>
            <input type="number" class="input-mini" id="lives" placeholder="">
            </div>
          </div>
        </div>
            
        <div class="control-group">
          <label class="control-label" for="inputArena">Arena Bonus</label>
          <div class="controls">
              
            <div class="input-prepend">
            <span class="add-on"><img src="/assets/home/img/announcementIcon.png" width="22px"></span>
            <input type="number" class="input-mini" id="Arena" placeholder="">
            </div>
          </div>
        </div>
            
            
        <div class="control-group">
          <label class="control-label" for="inputTotal">Total</label>
          <div class="controls">
            <input type="text" disabled="disabled" id="total">
          </div>
        </div>
                
        <div class="control-group">
          <label class="control-label" for="inputNotes">Notes</label>
          <div class="controls">
              <p>In here: Who they sacrificed, if that's important. Anything weird about any of the above. This is an OOC box, there is no prayer mechanic.</p>
            <textarea class="input-block-level" rows="3"></textarea>
          </div>
        </div>
            
        <div class="control-group">
          <div class="controls">
            <button type="submit" class="btn">Make it so.</button>
          </div>
        </div>
      </form>
    </div>
      
  </div>
</div>