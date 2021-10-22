<table class="table table-bordered" cellpadding="8">
    <tr class="bg-warning text-center">
        <th width="1%">ID</th>
        <th width="30%">Gambar</th>
        <th>Nama</th>
        <th>Harga</th>
    </tr>
    <?php
    if( ! empty($products)){
        foreach($products as $data){
            echo "<tr>";
            echo "<td align='center'>".$data->prod_id."</td>";
            echo "<td align='center'><img src='".base_url().'gambar/'.$data->prod_img."' style='width:50%;margin:auto;'/></td>";
            echo "<td>".$data->prod_name."</td>";
            echo "<td align='center'>".$data->prod_price."</td>";
            echo "</tr>";
        }
    }else{
        echo "<tr><td colspan='4'>Data tidak ada</td></tr>";
    } ?>
</table>