<template>
    <table class="rounded">
        <thead>
            <tr>
                <th><input type="checkbox" name="" id=""></th>
                <th></th>
                <th>Titulo</th>
                <th>Tipo de Reclamacao</th>
                <th>Local</th>
                <th>Data</th>
                <th>Usuario</th>
                <th>
                </th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <th><input type="checkbox" name="" id=""></th>
                <td class="fs-6"><span class="badge bg-primary">Nova!</span></td>
                <td><h6><i class="fa-regular fa-face-sad-tear  fs-5 me-1"></i> Lorem</h6></td>
                <td>
                    Cara-a-cara
                </td>
                <td>
                    Maputo
                </td>
                <td>
                    12/10/2024
                </td>
                <td>
                    <div class="d-flex gap-2 justify-content-center align-items-center">
                        <img src="/img/cat.jpg" width="30px" height="30px" alt="" class="rounded-circle">
                        <span class=" fw-semibold text-secondary">Raul Shelton</span>
                    </div>
                </td>
                <td>
                    <div class="d-flex gap-3 align-items-center">
                        <a href=""><i class="fa-solid fa-eye fs-6"></i></a>
                        <a href=""><i class="fa-solid fa-trash fs-6"></i></a>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</template>


<style scoped>
    table{
        width: 100%;
        background: white;
        box-shadow: 0 0 7px rgba(0, 0, 0, 0.4);
        border-collapse: collapse;
    }

    th,td{
        padding: 10px 0;
        padding-left: 10px;
        text-align: center;
        font-size: 14px;
    }

    thead tr,tbody tr{
        border-bottom: 1px solid rgb(202, 201, 201);
    }

    tbody tr:last-child{
        border: none;
    }

    a{
        text-decoration: none;
    }
</style>