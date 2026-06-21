<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Data Produk</title>
  <style>
    body { font-family: Arial, sans-serif; font-size: 12px; }
    table { border-collapse: collapse; width: 100%; margin-top: 20px; }
    th, td { border: 1px solid #000; padding: 6px; text-align: left; }
    th { background-color: #eee; }
    h3 { text-align: center; }
    img { width: 50px; height: auto; }
  </style>
</head>
<body>
<h3>Data Produk</h3>
<table>
  <thead>
    <tr><th>No</th><th>Foto</th><th>Nama Produk</th><th>Harga</th><th>Stok</th></tr>
  </thead>
  <tbody>
    <?php foreach ($produk as $i => $row): ?>
    <?php
      $path = FCPATH . 'uploads/' . $row['foto'];
      $base64 = '';
      if (!empty($row['foto']) && file_exists($path)) {
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
      }
    ?>
    <tr>
      <td><?= $i + 1 ?></td>
      <td>
        <?php if ($base64): ?>
          <img src="<?= $base64 ?>">
        <?php else: ?>
          -
        <?php endif; ?>
      </td>
      <td><?= esc($row['nama']) ?></td>
      <td>Rp<?= number_format($row['harga'], 0, ',', '.') ?></td>
      <td><?= $row['stok'] ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<p style="margin-top:20px;">Downloaded on <?= date("Y-m-d H:i:s") ?></p>
</body>
</html>
