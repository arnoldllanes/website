<template>
<div class="col-md-4 col-md-push-8">
	<form method="GET" role="search" class="navbar-form navbar-left">
        <div class="form-group">
            <input type="text" name="query" class="form-control" v-model="query" placeholder="Find friends or group"/>
        
            <a data-toggle="modal" data-target="#searchModal" type="button" @click="submitQuery" class="btn btn-primary">Search</a>
        </div>
    </form>
</div>
    <!-- Modal-->
    <div id="searchModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
        <!--    Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times</button>
                    <h4 class="modal-title">Search Results for '<small><em>{{ query }}</em></small>'</h4>
                </div>
                <div class="modal-body">
                <!-- Start content -->
                <h2>{{ presentationCount }} results found for presentations.</h2>
                	<div v-for="presentation in presentationResults">
                		<div class="media">
						    <a class="pull-left" href="">
						        <img class="media-object" alt="" src="">
						    </a>
						    <div class="media-body">
						        <a href="/presentations/{{ presentation.id }}"><h4 class="media-heading">{{ presentation.title }}</h4></a>
						    </div>
						</div>
                	</div>
                <hr>
                <h2>{{ presenterCount }} results found for presenters.</h2>
                	<div v-for="presenter in presenterResults">
                		<div class="media">
						    <a class="pull-left" href="">
						        <img class="media-object" alt="" src="">
						    </a>
						    <div class="media-body">
						        <a href="/presenters/{{ presenter.id }}"><h4 class="media-heading">{{ presenter.name }}</h4></a>
						    </div>
						</div>
                	</div>
                </div> 
            </div>
        </div>
    </div>  
</template>
<script>
	export default {
		data(){
			return {
				query:'',
				presentationResults: [],
				presentationCount: 0,
				presenterResults: [],
				presenterCount: 0
			}
		},
		methods: {
			submitQuery: function(e) {
				var Query = this.query;

				Vue.http.get('/search/' + Query).then((response) => {
					this.$set('presentationResults', response.data.presentations);
					this.$set('presentationCount', Object.keys(response.data.presentations).length);
					this.$set('presenterResults', response.data.presenters);
					this.$set('presenterCount', Object.keys(response.data.presenters).length);
				});
			}
		}
	}
</script>