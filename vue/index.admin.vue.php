<?php
    $lead = "Dashboard";
    ob_start();
?>
<?= $salutation ?>
<!-- <div class="container">
    <div class="row">
        <div class="col-sm-3 bg-danger m-1 p-2">
            <h1>Test du code</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. dolore nam delectus voluptatibus autem dolorum dignissimos eligendi libero rerum.</p>
        </div>
        <div class="col-sm-2 bg-secondary shadow m-1 p-2 rounded-3">
            <h1>Test du code</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit assumenda nobis numquam sapiente possimus, quasi voluptatum consequatur beatae architecto vitae nesciunt corrupti modi consequuntur vel veniam? Voluptas odit repellendus eaque.</p>
        </div>
        <div class="col-sm-2 bg-warning m-1 p-2">
            <h1>Test du code</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit assumenda nobis numquam sapiente possimus, quasi voluptatum consequatur beatae architecto vitae nesciunt corrupti modi consequuntur vel veniam? Voluptas odit repellendus eaque.</p>
        </div>
        <div class="col-sm-3 bg-primary m-1 p-2">
            <h1>Test du code</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit assumenda nobis numquam sapiente possimus, quasi voluptatum consequatur beatae architecto vitae nesciunt corrupti modi consequuntur vel veniam? Voluptas odit repellendus eaque.</p>
        </div>
    </div>
</div> -->
<?php require_once '../vue/ajouter.vue.php' ?>
<h2>Section title</h2>
<div class="table-responsive small">
<table class="table table-striped table-sm">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Header</th>
        <th scope="col">Header</th>
        <th scope="col">Header</th>
        <th scope="col">Header</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>1,001</td>
        <td>random</td>
        <td>data</td>
        <td>placeholder</td>
        <td>text</td>
    </tr>
    <tr>
        <td>1,002</td>
        <td>placeholder</td>
        <td>irrelevant</td>
        <td>visual</td>
        <td>layout</td>
    </tr>
    <tr>
        <td>1,003</td>
        <td>data</td>
        <td>rich</td>
        <td>dashboard</td>
        <td>tabular</td>
    </tr>
    <tr>
        <td>1,003</td>
        <td>information</td>
        <td>placeholder</td>
        <td>illustrative</td>
        <td>data</td>
    </tr>
    <tr>
        <td>1,004</td>
        <td>text</td>
        <td>random</td>
        <td>layout</td>
        <td>dashboard</td>
    </tr>
    <tr>
        <td>1,005</td>
        <td>dashboard</td>
        <td>irrelevant</td>
        <td>text</td>
        <td>placeholder</td>
    </tr>
    <tr>
        <td>1,006</td>
        <td>dashboard</td>
        <td>illustrative</td>
        <td>rich</td>
        <td>data</td>
    </tr>
    <tr>
        <td>1,007</td>
        <td>placeholder</td>
        <td>tabular</td>
        <td>information</td>
        <td>irrelevant</td>
    </tr>
    <tr>
        <td>1,008</td>
        <td>random</td>
        <td>data</td>
        <td>placeholder</td>
        <td>text</td>
    </tr>
    <tr>
        <td>1,009</td>
        <td>placeholder</td>
        <td>irrelevant</td>
        <td>visual</td>
        <td>layout</td>
    </tr>
    <tr>
        <td>1,010</td>
        <td>data</td>
        <td>rich</td>
        <td>dashboard</td>
        <td>tabular</td>
    </tr>
    <tr>
        <td>1,011</td>
        <td>information</td>
        <td>placeholder</td>
        <td>illustrative</td>
        <td>data</td>
    </tr>
    <tr>
        <td>1,012</td>
        <td>text</td>
        <td>placeholder</td>
        <td>layout</td>
        <td>dashboard</td>
    </tr>
    <tr>
        <td>1,013</td>
        <td>dashboard</td>
        <td>irrelevant</td>
        <td>text</td>
        <td>visual</td>
    </tr>
    <tr>
        <td>1,014</td>
        <td>dashboard</td>
        <td>illustrative</td>
        <td>rich</td>
        <td>data</td>
    </tr>
    <tr>
        <td>1,015</td>
        <td>random</td>
        <td>tabular</td>
        <td>information</td>
        <td>text</td>
    </tr>
    </tbody>
</table>
</div>
<?php
    $contenu = ob_get_clean();
    require_once '../layout/admin.php'; 
?>