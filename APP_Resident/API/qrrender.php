<!DOCTYPE html>
    <style>
        #qrcode{
            width: 90vw;
            margin: 0 auto;
            padding: 10px;
            text-align: center;
            align-content: center;
        }
    </style>
    <script src="../js/jquery_3.6.js"></script>
    <script src="../js/jquery.qrcode.min.js"></script>
    <script src="../js/reImg.js"></script>
    <div class="row">
        <div id="qrcode">
            
        </div>
    </div>
    <div class="row">
        <h5 id="qrcodeString" style="text-align: center;"></h5>
    </div>

    <script>
        $(document).ready( function(){
            let QRCode = "asd";
            $("#qrcode").qrcode({
				text : QRCode,
				width : $("#qrcode").width(),
				height : $("#qrcode").width()
			});
            $("#qrcodeString").html(QRCode)
            $("#qrcode").find("canvas").attr("id", "cvsQR");
            ReImg.fromCanvas(document.getElementById('cvsQR')).downloadPng();
        })
    </script>
</html>