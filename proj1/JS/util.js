$(document).ready(function(){
    var albumCount = 10;
        $("#album-srch-btn").click(function(){
            threadCount = threadCount + 10;
            $("#album-container").load("albumlist.dom.php", {
                albumNewCount: albumCount
        });
    });
});
