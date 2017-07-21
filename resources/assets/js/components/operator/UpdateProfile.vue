<script>
    import swal from 'sweetalert2';

    export default{

        data: function () {
            return{
                form:{
                    email:"",
                },
                user:'',
                errors: '',
                not_found:false,
            }
        },
        methods:{
            findUser: function () {
                axios.post('/user/find', {'form':this.form}).then(function (response) {
                  if (response.data){
                      this.user = response.data;
                      this.errors = '';
                      this.not_found = false;
                  } else {
                      this.user = '';
                      this.not_found = true;
                  }
                }.bind(this)).catch(function (error) {

                });
            },
            updateUserProfile: function () {
                axios.post('/operator/user/profile', this.user).then(function (response) {
                    if (!response.data.errors){
                        swal('SAVED', 'Ttn add success!', 'success');
                        this.user = response.data;
                        this.errors = '';
                    } else {
                        this.errors = response.data.errors;
                    }
                }.bind(this)).catch(function (error) {

                });
            }
        },

        mounted: function () {

        }

    }
</script>