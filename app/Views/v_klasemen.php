<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <title><?= $head ?></title>
</head>

<body>
    <div class="container mt-4">
        <div class="">
            <p>
                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample">
                    Tambah Tim
                </button>
                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample">
                    Tambah Match
                </button>
                <button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    Tambah Match Banyak
                </button>
            </p>
            <div class="collapse" id="collapseExample3">
                <div class="card card-body viewmultiple">
                    Form Tambah Tim
                    <hr>
                    <?= form_open('klasemen/tambahtim') ?>
                    <?= csrf_field(); ?>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Nama Tim</label>
                                <?php
                                $isInvalidNama = (session()->getFlashdata('err_nama')) ? 'is-invalid' : '';
                                ?>
                                <input type="text" class="form-control <?= $isInvalidNama ?>" name="tim" placeholder="Masukan Nama Tim" required>
                                <?php
                                if (session()->getFlashdata('err_nama')) {
                                    echo '<div class="invalid-feedback">
                                ' . session()->getFlashdata('err_nama') . '
                                </div>';
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Asal Kota</label>
                                <input type="text" class="form-control" name="kota" placeholder="Masukan Asal Kota">
                            </div>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-success btn-sm">Simpan</button>
                        </div>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
            <div class="collapse" id="collapseExample2">
                <div class="card card-body viewmultiple">
                    Form Tambah Data <br>
                    <hr>
                    <?= form_open('klasemen/simpandata') ?>
                    <?= csrf_field(); ?>
                    <p>
                        <button type="submit" class="btn btn-success btn-sm btnsimpanbanyak">
                            Simpan
                        </button>
                    </p>
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <select class="form-select" aria-label="Default select example" name="tim1">
                                        <?php
                                        foreach ($tampil as $nama) : ?>
                                            <option value="<?= $nama['nama'] ?>"><?= $nama['nama'] ?></option>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select>

                                </td>
                                <td align="middle">
                                    <h4>VS</h4>
                                </td>
                                <td>

                                    <select class="form-select" aria-label="Default select example" name="tim2">
                                        <?php
                                        foreach ($tampil as $nama) : ?>
                                            <option value="<?= $nama['nama'] ?>"><?= $nama['nama'] ?></option>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select>

                                </td>
                                <td align="right">
                                    <input type="number" class="form-control" name="skor1" placeholder="Skor">
                                </td>
                                <td align="center">
                                    <h4>-</h4>
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="skor2" placeholder="Skor">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <?= form_close(); ?>
                </div>
            </div>
            <div class="collapse mt-2" id="collapseExample">
                <div class="card card-body viewmultiple">
                    Form Tambah Data Banyak
                    <hr>
                    <?= form_open('klasemen/simpandatabanyak', ['class' => 'formsimpanbanyak']) ?>
                    <?= csrf_field(); ?>
                    <p>
                        <button type="submit" class="btn btn-success btn-sm btnsimpanbanyak">
                            Simpan
                        </button>
                    </p>
                    <table>
                        <tbody class="formtambah">
                            <tr>
                                <td>
                                    <select class="form-select" aria-label="Default select example" name="tim1[]">
                                        <?php
                                        foreach ($tampil as $nama) : ?>
                                            <option value="<?= $nama['nama'] ?>"><?= $nama['nama'] ?></option>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select>

                                </td>
                                <td align="middle">
                                    <h4>VS</h4>
                                </td>
                                <td>

                                    <select class="form-select" aria-label="Default select example" name="tim2[]">
                                        <?php
                                        foreach ($tampil as $nama) : ?>
                                            <option value="<?= $nama['nama'] ?>"><?= $nama['nama'] ?></option>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select>

                                </td>
                                <td align="right">
                                    <input type="number" class="form-control" name="skor1[]" placeholder="Skor">
                                </td>
                                <td align="center">
                                    <h4>-</h4>
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="skor2[]" placeholder="Skor">
                                </td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm btnaddform">
                                        Add
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
                <th>No</th>
                <th>KLUB</th>
                <th>Ma</th>
                <th>M</th>
                <th>S</th>
                <th>K</th>
                <th>GK</th>
                <th>GM</th>
                <th>Point</th>
            </thead>
            <?php
            $no = 0;

            foreach ($tampil as $row) :

                $no++;
            ?>
                <tbody>
                    <td><?= $no; ?></td>
                    <td><?= $row['nama'] ?></td>
                    <td><?= $row['main'] ?></td>
                    <td><?= $row['menang'] ?></td>
                    <td><?= $row['seri'] ?></td>
                    <td><?= $row['kalah'] ?></td>
                    <td><?= $row['gk'] ?></td>
                    <td><?= $row['gm'] ?></td>
                    <td><?= $row['point'] ?></td>
                </tbody>
            <?php
            endforeach;
            ?>

        </table>
    </div>

</body>

</html>
<script>
    $(document).ready(function() {

        $('.formsimpanbanyak').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnsimpanbanyak').attr('disable', 'disabled');
                },
                complete: function() {
                    $('.btnsimpanbanyak').removeAttr('disable');
                    $('.btnsimpanbanyak').html('Simpan');
                },
                success: function(response) {
                    if (response.sukses) {
                        window.location.href = ("<?= site_url('klasemen/index') ?>")
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            })
        });

        $('.btnaddform').click(function(e) {
            e.preventDefault();
            $('.formtambah').append(`
            <tr>
                                <td>
                                    <select class="form-select" aria-label="Default select example" name="tim1[]">
                                        <?php
                                        foreach ($tampil as $nama) : ?>
                                            <option value="<?= $nama['nama'] ?>"><?= $nama['nama'] ?></option>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select>

                                </td>
                                <td align="middle">
                                    <h4>VS</h4>
                                </td>
                                <td>

                                    <select class="form-select" aria-label="Default select example" name="tim2[]">
                                        <?php
                                        foreach ($tampil as $nama) : ?>
                                            <option value="<?= $nama['nama'] ?>"><?= $nama['nama'] ?></option>
                                        <?php
                                        endforeach;
                                        ?>
                                    </select>

                                </td>
                                <td align="right">
                                    <input type="number" class="form-control" name="skor1[]"  placeholder="Skor">
                                </td>
                                <td align="center">
                                    <h4>-</h4>
                                </td>
                                <td>
                                    <input type="number" class="form-control" name="skor2[]" placeholder="Skor">
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm btnremove">
                                        Delete
                                    </button>
                                </td>
                            </tr>
            `);
        });
    });
    $(document).on('click', '.btnremove', function(e) {
        e.preventDefault();
        $(this).parents('tr').remove();
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>