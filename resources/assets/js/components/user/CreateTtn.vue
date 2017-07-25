<script>
    import swal from 'sweetalert2';

    export default{

        data: function () {
            return{
                form:{
                    email:"",
                },
                ttn:{
                    user:false,
                    user_id:"",
                    email:"",
                    name:"",
                    middlename:"",
                    lastname:"",
                    phone:"",
                    fromregion:"",
                    fromlocation:"",
                    fromdepartment:"",
                    toregion:"",
                    tolocation:"",
                    todepartment:"",
                    weight: "",
                    height: "",
                    width: "",
                    depth: "",
                    price:0,
                },
                fromregions:[],
                fromlocations:[],
                fromdepartments:[],
                toregions:[],
                tolocations:[],
                todepartments:[],
                show:false,
                errors: "",
            }
        },
        methods:{
            findUser: function () {
                axios.post('/user/find', {'form':this.form}).then(function (response) {
                  if (response.data){
                      this.ttn.user = true;
                      this.ttn.user_id = response.data.id;
                      this.ttn.name = response.data.name;
                      this.ttn.middlename = response.data.middlename;
                      this.ttn.lastname = response.data.lastname;
                      this.ttn.phone = response.data.phone;
                  } else {
                      this.ttn.user = false;
                      this.ttn.name = '';
                      this.ttn.middlename = '';
                      this.ttn.lastname = '';
                      this.ttn.phone = '';
                  }
                }.bind(this)).catch(function (error) {

                });
                this.ttn.email = this.form.email;
                this.show = true;
                this.getFromRegions();
                this.getToRegions();
            },
            getFromRegions: function () {
                axios.get('/regions/listall').then(function (response) {
                    this.fromregions = response.data;
                }.bind(this)).catch(function (error) {
                    console.log(error);
                });
            },
            getFromLocation: function (id) {
                axios.post('/locations/getLocations', {'region_id':this.ttn.fromregion}).then(function (response) {
                    this.fromlocations = response.data;
                }.bind(this)).catch(function (error) {
                    console.log(error);
                });
            },
            getFromDepartments: function (id) {
                axios.post('/departments/getDepartmens', {'region_id':this.ttn.fromlocation}).then(function (response) {
                    this.fromdepartments = response.data;
                }.bind(this)).catch(function (error) {
                    console.log(error);
                });
            },
            getToRegions: function () {
                axios.get('/regions/listall').then(function (response) {
                    this.toregions = response.data;
                }.bind(this)).catch(function (error) {
                    console.log(error);
                });
            },
            getToLocation: function (id) {
                axios.post('/locations/getLocations', {'region_id':this.ttn.toregion}).then(function (response) {
                    this.tolocations = response.data;
                }.bind(this)).catch(function (error) {
                    console.log(error);
                });
            },
            getToDepartments: function (id) {
                axios.post('/departments/getDepartmens', {'region_id':this.ttn.tolocation}).then(function (response) {
                        this.todepartments = response.data;
                }.bind(this)).catch(function (error) {
                    console.log(error);
                });
            },
            calcPrice: function () {
                var  $wPrice = this.ttn.weight * 25;
                var  $vPrice = (this.ttn.width * this.ttn.height * this.ttn.depth) * 0.0025;
                  if ($wPrice > $vPrice){
                      this.ttn.price = Math.ceil($wPrice);
                  } else {
                      this.ttn.price = Math.ceil($vPrice);
                  }
            },
            createTtn: function () {
                axios.post('/ttn/store', {'ttn':this.ttn}).then(function (response) {
                    if (response.data.errors){
                        this.errors = response.data.errors;
                    } else {
                        swal('SAVED', 'TTN add success! Your TTN number '+response.data.id, 'success');
                            this.ttn.user=true;
                            this.ttn.user_id="";
                            this.ttn.email="";
                            this.ttn.name="";
                            this.ttn.middlename="";
                            this.ttn.lastname="";
                            this.ttn.phone="";
                            this.ttn.fromregion="";
                            this.ttn.fromlocation="";
                            this.ttn.fromdepartment="";
                            this.ttn.toregion="";
                            this.ttn.tolocation="";
                            this.ttn.todepartment="";
                            this.ttn.weight= "";
                            this.ttn.height= "";
                            this.ttn.width= "";
                            this.ttn.depth= "";
                            this.ttn.price=0;
                        this.errors = "";
                    }
                }.bind(this)).catch(function (error) {
                    console.log(error);
                });
            }
        },

        mounted: function () {

        }

    }
</script>