<?php require("header.php"); ?>
<div class="col-10 d-flex justify-content-center">
    <div class="vh-100 position-relative">
        <div id="lifeline" class="ms-5 ms-md-6 ms-xl-6 pt-3 h-100 position-absolute">
        </div>
        <div class="mx-40 w-100 pt-3 justify-content-center position-relative">
            <div class="">
                <div class="form-outline">
                    <input type="search" id="searchBar" class="form-control rounded-5" placeholder="Search" />
                    <label class="form-label" for="searchBar" hidden>Search</label>
                </div>
            </div>
            <div class="position-relative" id="searchResult">
            </div>
        </div>
        
    </div>
</div>
<?php require("footer.php"); ?>