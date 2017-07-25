<script>
    import swal from 'sweetalert2';

    export default{
        props:['track', 'to_location', 'from_location', 'current_location', 'car'],
        data: function () {
            return{
                form:{
                    current_location:this.current_location.id,
                },
                locations: {},
                status:this.track.status,
            }
        },
        methods:{
            getLocation: function () {
                axios.get('/locations/listall').then(function (response) {
                    this.locations = response.data;
                }.bind(this)).catch(function (error) {
                    console.log(error);
                });
            },
            saveTrack: function () {
                axios.post('/tracks/update/'+this.track.id, {'current_location':this.form.current_location}).then(function (response) {
                    this.status = response.data.status;
                    swal('SAVED', 'Track updated success!', 'success');
                }.bind(this)).catch(function (error) {
                    swal('Error', 'Somthing wrong! Try again later.', 'error');
                    console.log(error);
                });
            }
        },
        created: function(){
            Event.$on('trackstatus', function(response){
                this.status = response;
            }.bind(this));
        },
        mounted: function () {
          this.getLocation();
        }
    }
</script>