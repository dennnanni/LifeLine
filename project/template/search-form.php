<?php require("header.php"); ?>
<div class="d-flex">
    <div class="ms-5 ms-md-6 pt-3 vh-100" name="lifeline">
    </div>
    <div class="flex-grow-1 text-nowrap w-100 pt-3">
        <div class="ms-n40 me-40">
            <div class="form-outline">
                <input type="search" id="searchBar" class="form-control rounded-5" placeholder="Search" />
                <label class="form-label" for="searchBar" hidden>Search</label>
            </div>
        </div>
        <div id="searchResult">
        </div>
    </div>
</div>
<?php require("footer.php"); ?>