<script>
    import swal from 'sweetalert2';

    export default {
        data: function () {
            return{
                from_locations:[],
                to_locations:{},
                cars:{},
                form:{
                    from:'',
                    to:'',
                    car:''
                }
            }
        },
        methods: {
            getFromLocation: function () {
                axios.get('/ttn/cargofrom').then(function (response) {
                    this.from_locations = response.data;
                }.bind(this)).catch(function (errors) {
                    console.log(errors);
                });
            },
            getToLocation: function () {
                axios.get('/ttn/cargoto/'+this.form.from).then(function (response) {
                    this.to_locations = response.data;
                }.bind(this)).catch(function (errors) {
                    console.log(errors);
                });
            },
            getFreeCars: function () {
                axios.get('/cars/listall').then(function (response) {
                    this.cars = response.data;
                }.bind(this)).catch(function (errors) {
                    console.log(errors);
                });
            }
        },
        mounted: function () {
            this.getFromLocation();
            this.getFreeCars();
        }
    }

</script>