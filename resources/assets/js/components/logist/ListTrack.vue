<script>
    import swal from 'sweetalert2';

    export default{

        data: function () {
            return {
                tracks:[]
            }
        },
        methods:{
            getAllTracks: function (link) {
                axios.get(link).then(function (response) {
                    this.tracks = response.data;
                }.bind(this)).catch(function (errors) {
                    console.log(errors);
                });
            },
            getPage:function (pageNumber) {
                this.getAllTracks(this.pageUrl(pageNumber))
            },
            pageUrl:function (pageNumber) {
                return '/tracks/listall/?page='+pageNumber;
            },
            nextPage:function () {
                this.getAllTracks(this.tracks.next_page_url)
            },
            prevPage:function () {
                this.getAllTracks(this.tracks.prev_page_url)
            },

        },
        mounted: function () {
            this.getAllTracks('/tracks/listall');
        },
        created: function(){
            Event.$on('addtrackresponse', function(response){
                this.tracks.data.unshift(
                    {

                    });
            }.bind(this));
        }
    }
</script>