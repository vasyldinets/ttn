<script>
    export default{
        data: function () {
            return{
                form:{
                    track_id:'',
                },
                track: '',
                alert: false,
            }
        },
        methods:{
            findTrack: function () {
                axios.get('/tracks/find/'+this.form.track_id).then(function (response) {
                    if (response.data){
                        this.track = response.data;
                        Event.$emit('trackstatus', response.data.status);
                        this.alert = false;
                    } else {
                        this.alert = true;
                    }
                }.bind(this)).catch(function (error) {
                    console.log(error);
                });
            }
        },
    }
</script>