 <!-- ADD MODAL 2 START-->
 <div class="modal" id="add2Modal">
        <div class="modal-background" id="add2ModalBg"></div>
        <div class="modal-card">

            <header class="modal-card-head has-background-info">
                <p class="modal-card-title has-text-white"><i class="fa-solid fa-plus mr-3"></i>Add Vehicle Type</p>
                <button class="delete" aria-label="close" onclick="closeAdd2()"></button>
            </header>

            <section class="modal-card-body">

                <div class="field">
                    <label for="" class="label">Vehicle Type</label>
                    <div class="control has-icons-left">
                        <input type="text" placeholder="Enter vehicle type here" class="input is-rounded" name="typeAdd2" id="typeAdd2">
                        <span class="icon is-small is-left">
                            <i class="fa-solid fa-hashtag"></i>
                        </span>
                    </div>
                    <p class="help" id="typeAdd2Help"></p>
                </div>

                <div class="field has-text-centered mt-6">
                    <button class="button is-info has-text-white is-rounded" name="submitAdd2Form" id="submitAdd2Form">
                        <i class="fa-solid fa-check mr-3"></i>Submit
                    </button>
                    <p class="help" id="submitAdd2FormHelp" style="text-align: center;"></p>
                </div>

            </section>
        </div>
    </div>
    <!-- ADD MODAL 2 END-->