<?php
function index()
{
    if (empty($_SESSION['goods'])) {
        return 'Нет товаров в корзине';
    }

    $inSql = implode(',', array_keys($_SESSION['goods']));
    $sql = "SELECT id, url, name, price, count FROM gallery2 WHERE id IN ($inSql)";
    $res = mysqli_query(connect(), $sql);

    $orderInfo = [];
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        while ($row = mysqli_fetch_assoc($res)) {
            $id = $row['id'];
            $orderInfo[] = [
                'id' => $row['id'],
                'price' => $row['price'],
                'count' => $_SESSION['goods'][$id],
            ];
        }


        mysqli_query(connect(), $sql);
        unset($_SESSION['goods']);
        $_SESSION['msg'] = 'Ваш заказ добавлен';
        header('Location: ?page=basket');
        exit;
    }

    $content = '<h1>Корзина</h1>';
    $content .= '<a href="?page=goods">Все товары</a><br><br><br>';

    while ($row = mysqli_fetch_assoc($res)) {
        $id = $row['id'];
        $count = $_SESSION['goods'][$id];
        $totalPrice = $count * $row['price'];
        $content .= <<<php
        <div class="d-flex flex-row">
        <div><img class='card-img-top' src='img/$row[url]' alt='$row[name]' style='width: 100px; display: block;'></div>
        <div>
			<a href="?page=goods&func=one&id=$id">{$row['name']}</a>
			<p>
				Количество:
				<a href="?page=basket&func=del&id={$id}">-</a>
				$count 
				<a href="?page=basket&func=add&id={$id}">+</a>

			</p>
			<p>Цена: {$totalPrice}.р</p>
			</div>
			</div>

			<hr>
php;
    }
    $content .= getform();

    return $content;
}

function add()
{
    $id = (int)$_GET['id'];
    if (!empty ($_SESSION['goods'][$id])) {
        $_SESSION['goods'][$id] += 1;
    } else {
        $_SESSION['goods'][$id] = 1;
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        return count($_SESSION['goods']);
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;

}

function del()
{
    $id = (int)$_GET['id'];
    if (!empty ($_SESSION['goods'][$id])) {
        $_SESSION['goods'][$id] -= 1;
    }

    if (isset($_SESSION['goods'][$id]) && $_SESSION['goods'][$id] < 1) {
        unset($_SESSION['goods'][$id]);
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;

}

function addAjax()
{
    echo add();
    exit;
}

function getform()
{
    return <<<php
	<form action="?page=basket&func=basketSendOrder" method="post" class="container" style="width: 700px;">
	<div class="form-row">
		<input class="form-control col mr-3" type="text" name="name" placeholder="name">
		<input class="form-control col mr-3" type="text" name="address" placeholder="address">
		<button class='btn btn-primary' type="submit">Отправить</button>
	</div>
	</form>
php;
}

function basketSendOrder()
{
    if (strlen($_POST['name']) != 0 && strlen($_POST['address']) != 0) {
        accountOrders();

        $name = clearStr($_POST['name']);
        $address = clearStr($_POST['address']);
        $orderInfo = json_encode($_SESSION['arrayOrder']);

        $sql = "INSERT INTO order (name, address, orderInfo) 
          VALUES ('$name', '$address', '$orderInfo')";
        mysqli_query(connect(), $sql);

        unset($_SESSION['goods']);
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

function accountOrders()
{
    if (!empty ($_SESSION['IS_USER'])) {
        $_SESSION['orders'] += 1;
    }
}