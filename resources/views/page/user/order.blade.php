@extends()

<!-- Breadcrumb -->
<div class="breadcrumb container">
    <ol>
        <li><a href="/home">Home</a></li>
        <li>Order</li>
    </ol>
</div>

<!-- List Order -->
<section class="table-order">
    <table>
        <tr>
            <th>Product</th>
            <th>Warna</th>
            <th>Quantity</th>
            <th>Harga</th>
            <th>Total</th>
        </tr>
        <tr>
            <td>
                <img src="asset/image2/girl-8.jpg" alt="" />
                Keyboar Mechanical Vorte
            </td>
            <td>Black</td>
            <td>1</td>
            <td>Rp. 500.000</td>
            <td>Rp. 500.000</td>
            <td class="delete-button">
                <a href="#"><img src="asset/icon/fa-times.svg" /></a>
            </td>
        </tr>
    </table>
</section>

<!-- Shipping -->
<section class="pesan">
    <form action="#" method="POST">
        <!-- List Orderean Product -->
        <input type="hidden" name="product" />
        <input type="hidden" name="warna" />
        <input type="hidden" name="qty_product" />
        <div class="form-group">
            <label for="Pengiriman">Pengiriman</label>
            <select name="pengiriman" id="pengiriman">
                <option value="">Layanan Pengiriman</option>
                <option value="">JNE</option>
                <option value="">TIKI</option>
            </select>
        </div>
        <div class="form-group">
            <label for="layanan_pengiriman">Layanan Pengirman</label>
            <select name="layanan_pengiriman" id="layanan_pengiriman">
                <option value="">JNE Reguler 2000 Estimasi 2 hari</option>
                <option value="">JNE Reguler 2000 Estimasi 2 hari</option>
                <option value="">JNE Reguler 2000 Estimasi 2 hari</option>
            </select>
        </div>
        <h3>Total : Rp. 10.000.000</h3>
        <button class="btn-checkout">Checkout</button>
    </form>
</section>