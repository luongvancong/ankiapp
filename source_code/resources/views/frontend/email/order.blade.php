<!DOCTYPE html>
<html>
<head>
    <title>Thông báo đơn hàng của bạn</title>
</head>
<body style="font-family: tahoma, arial, sans-serif">
    <h1 style="text-transform: uppercase; text-align: center;">Thông tin đơn hàng</h1>
    <div style="text-align: center;">
        <p>Chào {{ $order->getCustomerEmail() }}!</p>
        <p>Cảm ơn bạn đã sử dụng dịch vụ của <a href="http://{{ $_SERVER['SERVER_NAME'] }}/">{{ $_SERVER['SERVER_NAME'] }}</a></p>
        <p>Sau đây là thông tin đơn hàng của bạn</p>
    </div>
    <table style="width: 100%">
        <thead>
            <th style="border: 1px solid #ccc; padding: 5px; text-transform: uppercase;">Thông tin đơn hàng</th>
        </thead>
        <tbody>
            <tr>
                <td style="border: 1px solid #ccc;">
                    <table style="width: 100%;">
                        <tr>
                            <td style="padding: 5px; text-align: center;">Mã đơn hàng</td>
                            <td style="padding: 5px; text-align: center;">{{ $order->getCode() }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="table" style="width: 100%; margin-top: 30px;">
        <thead>
            <th style="border: 1px solid #ccc; padding: 5px;">Chuyến</th>
            <th style="border: 1px solid #ccc; padding: 5px;">Ngày/giờ khởi hành</th>
            <th style="border: 1px solid #ccc; padding: 5px;">Giá vé</th>
            <th style="border: 1px solid #ccc; padding: 5px;">SL vé</th>
            <th style="border: 1px solid #ccc; padding: 5px;">Tiền</th>
        </thead>
        <tbody>
            @foreach($orderDetail as $item)
                <?php
                    $trip = $item->trip()->first();
                ?>
                <tr>
                    <td style="text-align: center; border: 1px solid #ccc; padding: 5px;">{{ $trip->startPlace()->first()->getName() }}->{{ $trip->endPlace()->first()->getName() }}</td>
                    <td style="text-align: center; border: 1px solid #ccc; padding: 5px;">{{ $trip->presenter()->getStartDate('d/m/Y') }}&nbsp;{{ $trip->presenter()->getStartHour() }}</td>
                    <td style="text-align: center; border: 1px solid #ccc; padding: 5px;">{{ $item->presenter()->getPrice() }} vnđ</td>
                    <td style="text-align: center; border: 1px solid #ccc; padding: 5px;">{{ $item->getTicket() }}</td>
                    <td style="text-align: center; border: 1px solid #ccc; padding: 5px;">{{ $item->presenter()->getTotalMoney() }} vnđ</td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: right; padding: 5px;">Tổng tiền</td>
                    <td style="text-align: center; padding: 5px;">{{ $order->presenter()->getTotalMoney() }} vnđ</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>