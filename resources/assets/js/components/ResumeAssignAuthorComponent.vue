<template>
    <div class="dropdown">
        <a class="btn btn-link dropdown-toggle px-0 py-2 w-100 text-left" href="#" role="button" id="dropdown-authors" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="d-inline mr-2">
                <img data-src="holder.js/45x45" class="rounded-circle" alt="45x45" style="width: 45px; height: 45px;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%22200%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%20200%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_1646211c6f3%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_1646211c6f3%22%3E%3Crect%20width%3D%22200%22%20height%3D%22200%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2274%22%20y%3D%22104.8%22%3E200x200%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">
            </span>

            <span v-text="author.name"></span>
        </a>

        <div class="dropdown-menu w-100" aria-labelledby="dropdown-authors">
            <div class="px-3 py-2">
                <input type="search" class="form-control" placeholder="John Smith" autofocus="autofocus"
                    v-on:input="fetchUsers"
                    v-on:keyup.enter="fetchUsers"
                    v-model="selectedAuthor">
            </div>

            <div>
                <div class="py-2" v-if="authors.length > 0">
                    <div class="dropdown-item cursor-pointer d-flex px-3"
                        v-for="(user, index) in authors"
                        v-bind:index="index"
                        v-bind:key="index"
                        v-on:click="setAuthor(user)">
                        <div class="mr-2 mt-2">
                            <div v-if="user.avatar.length > 0">
                                <img class="rounded-circle" style="width: 30px; height: 30px;" v-bind:src="user.avatar">
                            </div>

                            <div v-else>
                                <img class="rounded-circle" style="width: 30px; height: 30px;" v-bind:src="defaultAvatar">
                            </div>
                        </div>

                        <div>
                            <span class="d-block font-weight-bold text-truncate" style="max-width: 145px;"
                                    v-text="user.name"></span>
                            <span class="text-muted"
                                    v-text="'@' + user.username"></span>
                        </div>
                    </div>
                </div>

                <div class="dropdown-header text-center" v-else>
                    <span>No user found.</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from "vuex";

    export default {
        computed: {
            ...mapGetters([
                "author"
            ])
        },

        data() {
            return {
                authors: [],
                selectedAuthor: ""
            };
        },

        methods: {
            /**
             * Fetches the authors based on the typed term.
             * 
             * @returns {void}
             */
            fetchUsers: _.debounce(function() {
                if (this.selectedAuthor.length < 1) {
                    return;
                }

                // Clear the author's list before making the new search to
                // hide the existing list from the screen.
                this.authors = [];

                const AUTHORS_URL = APP_API + '/users';

                axios
                    .get(AUTHORS_URL, {
                        params: {
                            term: this.selectedAuthor
                        }
                    })
                    .then(response => {
                        this.authors = response.data.data;
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }, 500),

            /**
             * Sets the supplied user as an author of the resume.
             *
             * @param   {Object} author
             *
             * @returns {void}
             */
            setAuthor(author) {
                this.$store.dispatch("updateAuthor", author);
            }
        },

        props: {
            defaultAvatar: String
        },

        watch: {
            selectedAuthor(value) {
                // Reset all the authors list to hide them from screen
                // whenever the user clears term in the input field.
                if (value.length < 1) {
                    this.authors = [];
                }
            }
        }
    };
</script>
