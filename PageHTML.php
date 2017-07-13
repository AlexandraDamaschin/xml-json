<!DOCTYPE html>
<html>
<title>Web</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<body class="w3-light-grey">

<div class="w3-content" >

    <!-- Header -->
    <header class="w3-container w3-center w3-padding-32">
        <?php include "Header.php"; ?>
    </header>

    <!-- Grid -->
    <div class="w3-row">
        <div class="w3-card-4 w3-margin w3-white blog-entries">
            <!-- Blog entry -->
            <?php
            ob_start();
            include('PageEntry.php');
            $pageTemplateEntry = ob_get_clean();

            ob_start();
           // include('data.xml'); i`m not really sure about this
          //  $pageData = ob_get_clean();
            ?>
            <script>
                var xml = <?php echo json_encode($pageData);?>;
                var template = <?php echo(json_encode($pageTemplateEntry));?>;
                var parser = new DOMParser();
                var xmlDoc = parser.parseFromString(xml, "text/xml");

                var pages = xmlDoc.getElementsByTagName("page");
                for (var i = 0; i < 2; i++) {
                    var html = template;
                    var page = pages[i];
                    html = html.replace('{$image}',  page.getElementsByTagName("image")[0].childNodes[0].nodeValue);
                    html = html.replace('{$alt}',  page.getElementsByTagName("alt")[0].childNodes[0].nodeValue);
                    html = html.replace('{$title}', page.getElementsByTagName("title")[0].childNodes[0].nodeValue);
                    html = html.replace('{$description}',  page.getElementsByTagName("description")[0].childNodes[0].nodeValue);
                    html = html.replace('{$date}',  page.getElementsByTagName("date")[0].childNodes[0].nodeValue);
                    html = html.replace('{textDescription}',  page.getElementsByTagName("textDescription")[0].childNodes[0].nodeValue);
                    $(".pages-entries").append(html);
                }
            </script>

            <!-- END BLOG ENTRIES -->
        </div>


        <!-- END Introduction Menu -->
    </div>

    <!-- END GRID -->
<br>

<!-- END w3-content -->
<footer class="w3-container w3-dark-grey w3-padding-32 w3-margin-top">
    <?php include "Footer.php"; ?>
</footer>
    
</body>
</html>
