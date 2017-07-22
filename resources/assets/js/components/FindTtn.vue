<script>
    export default{
        data: function () {
            return{
                form:{
                    id: '',
                },
                ttn:'',
                sender:'',
                recipient:'',
                current_position:'',
                alert:false,
            }
        },
        methods:{
            findTtn: function () {
                axios.post('/ttn/find', {'ttn_id':this.form.id}).then(function (response) {
                    if (response.data){
                        this.ttn = response.data;
                        if(response.data.sender && response.data.recipient){
                            this.sender = response.data.sender.profile;
                            this.recipient = response.data.recipient.profile;
                        }

                        if (response.data.track){
                            this.current_position = response.data.track.current_location.name;
                        } else {
                            this.current_position = response.data.from_department.location.name;
                        }
                        this.alert=false;
                    } else {
                        this.ttn = '';
                        this.alert=true;
                    }

                }.bind(this)).catch(function (error) {
                    console.log(error);
                });
            }
        }
    }
</script>