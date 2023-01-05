document.addEventListener('alpine:init', () => {
    Alpine.data('tributeFormComponent', (config) => ({
        isFetching: false,
        fetchThrottlingTimeout: null,

        init() {
            this.$nextTick(
                () => {

                }
            )

            // console.log(config)

            const tribute = new Tribute(this.initMentionableTrigger(config.mentions));

            tribute.attach(this.$refs.trix);

            // const editor = this.$refs.trix.editor;
            //
            // if (editor !== null) {
            //     console.log(editor.composition)
            //     editor.composition.delegate.inputController.events.keypress = function () {};
            //     editor.composition.delegate.inputController.events.keydown = function () {};
            // }
        },
        initTributeConfig(config) {
            return {
                fillAttr: config.fillAttr,
                selectClass: config.selectClass,
                containerClass: config.containerClass,
                itemClass: config.itemClass,
                allowSpaces: config.allowSpaces,
                replaceTextSuffix: config.replaceTextSuffix,
                requireLeadingSpace: config.requireLeadingSpace,
                positionMenu: config.positionMenu,
                spaceSelectsMatch: config.spaceSelectsMatch,
                autocompleteMode: config.autocompleteMode,
                menuItemLimit: config.menuItemLimit,
                menuShowMinLength: config.menuShowMinLength,
            }
        },
        initMentionableTrigger(config) {
            return {
                ...this.initTributeConfig(config),
                ...{
                    trigger: "@",
                    values: (text, cb) => {
                        this.searchMentionable(text, (mentionables) => cb(mentionables))
                    },
                    lookup: (user) => user.username + user.full_name,
                    menuItemTemplate: (item) => {
                        const { profile_photo_url, username, name, last_name, is_following } = item.original;

                        return `
                            <span class="flex items-center p-2">
                                <img class="rounded-full w-14 h-14 mr-2" src="${profile_photo_url}" />
                                <span>
                                    <span class="font-semibold">
                                        ${name ? name : ""} ${last_name ? last_name : ""}
                                    </span>
                                    <span class="block text-gray-500 text-sm font-light">
                                        @${username}
                                    </span>

                                    ${
                                        is_following
                                        ? `<span class="flex items-center text-gray-500 text-sm font-light space-x-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 fill-current" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                                <span>
                                                    Following
                                                </span>
                                            </span>
                                            `
                                        : ""
                                    }
                                </span>
                            </span>`;
                    },
                    selectTemplate: (item) => {
                        const editor = this.$refs.trix.editor;

                        return `<span contenteditable="false"><a href="#" class="text-primary-500" title="@${item.original.username}">@${item.original.username}</a></span>`;
                    },
                    noMatchTemplate: () => "<li>No users Found!</li>",
                }
            }
        },
        async searchMentionable(text, cb) {
            if (text === '') {
                cb([]);
            } else {
                this.isFetching = true;

                if (this.fetchThrottlingTimeout) {
                    clearTimeout(this.fetchThrottlingTimeout);
                }

                // Workaround to reduce the amount of request while user is typing
                this.fetchThrottlingTimeout = setTimeout(() => {
                    let query = `?query=${text}`;

                    fetch(`${config.mentions.endpoint}${query}`)
                        .then((response) => response.json())
                        .then((result) => cb(result))
                        .catch((error) => {
                            if (error.name !== "AbortError") {
                                throw error;
                            }
                        });

                    this.fetchThrottlingTimeout = null;
                }, 100);

                this.isFetching = false;
            }
        }
    }))
})
