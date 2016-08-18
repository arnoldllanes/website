<template>
<div class="image-popup text-center">
	<div id="meetup-component">
		<img src="/images/laravelicon.png">			
		<h2 class="meetup-title-display"><a href="{{ meetup.link }}">{{ meetup.summary }}</a></h2>
		<ul class="meetup-list-display">
			<li><i class="fa fa-clock-o" aria-hidden="true"></i> <span id="meetup-when">{{ meetup.time }}</span></li>
			<li><i class="fa fa-users" aria-hidden="true"></i> Rsvps: <span id="meetup-rsvps">{{ meetup.rsvps }}</span></li>
			<li>Updated on: {{ meetup.updated }}</li>
		</ul>
		<a id="join-button" type="button" class="btn btn-danger" href="{{ meetup.link }}">Join MeetUp</a>
	</div>
</div>
</template>

<style>
	li {
		color:black;
	}
	#meetup-when, #meetup-rsvps {
		font-weight: 500;
	}
</style>

<script>
	export default {
		ready(){
			this.fetchNextMeetUp();
		},

		data() {
			return {
				meetup: []
			}
		},
		methods: {
			fetchNextMeetUp: function () {
				Vue.http.get('https://flickering-heat-5459.firebaseio.com/meetups/San-Diego-Laravel-Meetup.json').then((response) => {
					this.$set('meetup', response.data);
				});
			}
		}
	}
</script>