<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" 
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
    <h3 class="text-center mb-5">Phản hồi của khách hàng</h3>

    <table class="table table-bordered mx-auto" style="max-width: 800px">
        <tr>
            <td class="font-weight-bold">Email</td>
            <td>{{ $datas['addressEmail'] }}</td>
        </tr>
        <tr>
            <td class="font-weight-bold">Nội dung phản hồi</td>
            <td>{{ $datas['content'] }}</td>
        </tr>
    </table>
</body>
</html>