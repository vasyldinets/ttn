<script>
    import swal from 'sweetalert2';

    export default{

        data: function () {
            return{
                form_sender:{
                    email:"",
                },
                form_recipient:{
                    email:"",
                },
                ttn:{
                    sender_user: false,
                    sender_user_id:"",
                    sender_email:"",
                    sender_name:"",
                    sender_middlename:"",
                    sender_lastname:"",
                    sender_phone:"",
                    recipient_user: false,
                    recipient_user_id:"",
                    recipient_email:"",
                    recipient_name:"",
                    recipient_middlename:"",
                    recipient_lastname:"",
                    recipient_phone:"",
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
                errors: "",
                showSenderErr: false,
                showPecipientErr: false,
            }
        },
        methods:{
            findSenderUser: function () {
                axios.post('/user/find', {'form':this.form_sender}).then(function (response) {
                  if (response.data){
                      this.ttn.sender_user = true;
                      this.showSenderErr = false;
                      this.ttn.sender_user_id = response.data.id;
                      this.ttn.sender_name = response.data.name;
                      this.ttn.sender_middlename = response.data.middlename;
                      this.ttn.sender_lastname = response.data.lastname;
                      this.ttn.sender_phone = response.data.phone;
                  } else {
                      this.ttn.sender_user = false;
                      this.showSenderErr = true;
                      this.ttn.sender_name = '';
                      this.ttn.sender_middlename = '';
                      this.ttn.sender_lastname = '';
                      this.ttn.sender_phone = '';
                  }
                }.bind(this)).catch(function (error) {

                });
                this.ttn.sender_email = this.form_sender.email;
            },
            findRecipientUser: function () {
                axios.post('/user/find', {'form':this.form_recipient}).then(function (response) {
                    if (response.data){
                        this.ttn.recipient_user = true;
                        this.showPecipientErr =false;
                        this.ttn.recipient_user_id = response.data.id;
                        this.ttn.recipient_name = response.data.name;
                        this.ttn.recipient_middlename = response.data.middlename;
                        this.ttn.recipient_lastname = response.data.lastname;
                        this.ttn.recipient_phone = response.data.phone;
                    } else {
                        this.ttn.recipient_user = false;
                        this.showPecipientErr =true;
                        this.ttn.recipient_name = '';
                        this.ttn.recipient_middlename = '';
                        this.ttn.recipient_lastname = '';
                        this.ttn.recipient_phone = '';
                    }
                }.bind(this)).catch(function (error) {

                });
                this.ttn.recipient_email = this.form_recipient.email;
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
                axios.post('/ttn/operator/store', {'ttn':this.ttn}).then(function (response) {
                    if (response.data.errors){
                        this.errors = response.data.errors;
                    } else {
                        swal('SAVED', 'Ttn add success!', 'success');
                            this.ttn.sender_user=true;
                            this.ttn.sender_user_id="";
                            this.ttn.sender_email="";
                            this.ttn.sender_name="";
                            this.ttn.sender_middlename="";
                            this.ttn.sender_lastname="";
                            this.ttn.sender_phone="";
                            this.ttn.recipient_user=true;
                            this.ttn.recipient_user_id="";
                            this.ttn.recipient_email="";
                            this.ttn.recipient_name="";
                            this.ttn.recipient_middlename="";
                            this.ttn.recipient_lastname="";
                            this.ttn.recipient_phone="";
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