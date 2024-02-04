<?php require("header.php"); ?>
<div class="w-100 flex-grow-1 d-flex justify-content-center mb-9">
    <div class="col-10 col-md-7 col-lg-5 col-xl-4 position-relative">
        <div class="lifeline ms-7 pt-4 h-100 position-absolute">
        </div>
        <div class="col-6 w-100 pt-4 justify-content-center position-relative">
            <div class="form-outline">
                <input type="search" id="searchBar" class="form-control rounded-5" placeholder="Search" />
                <label class="form-label" for="searchBar" hidden>Search</label>
            </div>
            <div class="ms-4 position-relative" id="searchResult">
            </div>
        </div>
    </div>
</div>
<?php require("footer.php"); ?>