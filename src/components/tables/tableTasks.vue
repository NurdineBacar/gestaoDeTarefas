<template>
  <table class="rounded">
    <thead>
      <tr>
        <th><input type="checkbox" name="" id="" /></th>
        <th></th>
        <th>Titulo</th>
        <th>Nivel de Prioridade</th>
        <th>Responsavel</th>
        <th>Data</th>
        <th>Estado</th>
        <th></th>
      </tr>
    </thead>

    <tbody>
      <tr>
        <th><input type="checkbox" name="" id="" /></th>
        <td class="fs-6"><span class="badge bg-primary">Nova!</span></td>
        <td class="fw-semibold">Lorem</td>
        <td>
          <span class="badge bg-danger">Urgente</span>
        </td>
        <td>
          <div class="d-flex gap-2 justify-content-center align-items-center">
            <img
              src="/img/cat.jpg"
              width="30px"
              height="30px"
              class="rounded-circle"
              alt="user-img"
            />
            <span>Raul Shelton</span>
          </div>
        </td>
        <td>20/10/2024</td>
        <td>
            <span
                class="badge bg-warning"
                >Pendente</span
            >
            
        </td>
        <td>
         <div class="d-flex gap-3">
            <a href=""><i class="fa-solid fa-arrow-up-right-from-square fs-5"></i></a>
            <a href=""><i class="fa-solid fa-trash fs-5"></i></a>
         </div>
        </td>
      </tr>
    </tbody>
  </table>
</template>


<style scoped>
table {
  width: 100%;
  background: white;
  box-shadow: 0 0 7px rgba(0, 0, 0, 0.4);
  border-collapse: collapse;
}

th,
td {
  padding: 10px 0;
  padding-left: 10px;
  text-align: center;
  font-size: 14px;
}

thead tr,
tbody tr {
  border-bottom: 1px solid rgb(202, 201, 201);
}

tbody tr:last-child {
  border: none;
}

a {
  text-decoration: none;
}
</style>