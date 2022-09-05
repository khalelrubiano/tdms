<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Display a map</title>
    <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        .or {
            border: 2px solid #8fc300;
            border-radius: 5px;
            color: #333;
            font-size: 17px;
            font-weight: 600;
            height: 34px;
            line-height: 26px;
            text-align: center;
            width: 34px;
            margin-top: 64px;
            margin-left: 20px;
            margin-right: 20px;
            /*For z-index - keep the green area on top*/
            position: relative;
        }

        .or::after {
            background: red;
            content: "";
            display: block;
            height: 116px;
            margin-left: 15px;
            margin-top: -68px;
            width: 4px;
            /*For z-index - keep the green area on top*/
            position: absolute;
            z-index: -1;
        }
    </style>
</head>

<body>
    <div class="container">
        <div>
            <div class="or"></div>
        </div>

    </div>
</body>

</html>