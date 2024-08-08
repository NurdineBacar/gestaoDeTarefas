<template>
    <table class="rounded">
        <thead>
            <tr>
                <th>
                    Colaborador
                </th>
                <th>Contacto</th>
                <th>Email</th>
                <th>Tipo Colaborador</th>
                <th>Estado</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td class="fs-6">
                    <div class="d-flex gap-2 justify-content-center">
                        <img src="/img/cat.jpg" width="30px" height="30px" alt="" class="rounded-circle">
                        <h6>Raul Shelton</h6>
                    </div>
                </td>
                <td>841234567</td>
                <td>
                    raulshelton@gmail.com
                </td>
                <td>
                    <span
                        class="badge bg-primary"
                        >Gestor</span
                    >
                    
                </td>
                <td>
                    <span
                        class="badge bg-primary"
                        >Activo</span
                    >
                </td>
                <td>
                    <div class="d-flex gap-3 align-items-center">
                        <a href=""><i class="fa-solid fa-edit fs-6"></i></a>
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