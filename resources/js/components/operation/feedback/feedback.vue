<template>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>
                <i class="nav-icon fas fa-user-friends"></i>&nbsp;Feadback
              </h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                  <router-link to="/">Operation</router-link>
                </li>
                <li class="breadcrumb-item active">Feadback</li>
              </ol>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </section>
      </div>
        <div class="card">
        <div class="card-header">
          <h3 class="card-title">Feadback List</h3>

          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 250px;">
              <label for></label>
              <select @change="feedback" class="form-control" name id v-model="page_count">
                <option v-for="(item,index) in ppi" :key="index">{{item}}</option>
              </select>              
            </div>
          </div>
        </div>
        <!-- /.card-header table-head-fixed -->
        <div class="card-body table-responsive p-0" style="height: 600px;">
          <table class="table">
            <thead>
              <tr>
                <th class="text-center">#</th>
                <th class="text-center">Comment</th>
                <th class="text-center">Reaction</th>
              </tr>
            </thead>
            <tbody>
               <tr v-for="feedback_details in feedback.data" :key="feedback_details.id">
                   <td class="text-center">{{feedback_details.id}}</td>
                   <td class="text-center">{{feedback_details.comment}}</td>
                   <td class="text-center">{{feedback_details.status}}</td>
               </tr>
            </tbody>
          </table>

          <div v-if="load_data" class="d-flex justify-content-center mt-5">
            <div class="spinner-border" role="status">
              <span class="sr-only">Loading...</span>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <pagination
            v-if="load_data==false"
            class="float-right"
            :limit="2"
            :data="feedback"
            @pagination-change-page="loadFeadback"
          ></pagination>
        </div>
        <!-- /.card -->
      </div>
    </div>
</template>

<script>
export default {
    data()
    {
        return{
            page_count: 10,
            errors: [],
            feedback: [],
            isEdit: false,  
            load_data: true,
            ppi: []
        }
    },
    mounted() {        
        this.load_data == true;
        this.itemPerPage();
        this.loadFeadback();
    },
    methods: {
        
        itemPerPage() {
            
      axios.get("/prp").then(res => {
        if (res.status == 200) {
          this.ppi = res.data;
        }
      });
    },
    loadFeadback(page = 1)
    {
        this.load_data = true;
        axios.post('/get/customer/feedback?page=' + page,{
           rpp: this.page_count,
        }).then(res=>{
                if(res.status == 200)
                {
                    console.log(res);
                    this.load_data = false;
                    this.feedback = res.data;    
                }
        });
    }

    },
}
</script>