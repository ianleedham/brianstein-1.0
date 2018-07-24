<template>
    <div>
        <div class="row quiz_index">
            <div class="col-md-3">
            </div>

            <text-question
                        v-show="next.type==='multiple_choice'||next.type==='reversed_multiple_choice'"
                        v-bind:question = "question"
                        v-on:question:answered="LoadNextQuestion"
                ></text-question>
                <typed-question
                        v-show="next.type==='typed_question'"
                        v-bind:question = "question"
                        v-on:question:answered="LoadNextQuestion"
                ></typed-question>

        </div>

    </div>
</template>

<script>
    import AudioQuestion from './partials/sound_question'
    import TextQuestion from './partials/text_question'
    import TypedQuestion from './partials/typed_question'
    import Present from './partials/presentaion'
    export default {
        components: {
            TextQuestion,
            TypedQuestion,
            AudioQuestion,
            Present
        },
        props: {},
        data() {
            return {
                results: {},
                next: {
                    type: "typed_question",
                    index: 0,
                },
                example: {
                    level: {
                        index: 1,
                        url: '',
                        title: '',
                        number_of_items: ''
                    },
                    questions: {
                        question_id: 1,
                        item: {
                            kind: 'text',
                            value: 'Monday',
                            label: 'English'
                        },
                        answer: {
                            label: 'cantonese',
                            value: '星期一'
                        },
                        confused_answers: {},
                        answer_1: '星期一',
                        answer_2: '星期三',
                        answer_3: '星期四',
                        answer_4: '星期六'
                    }
                },

                "learnables": [
                    {
                        "learnable_id": "1026545222147",
                        "thing_id": 15663837,
                        "item": {},
                        "definition": {
                            "kind": "text",
                            "value": "gwai6",
                            "label": "Pronunciation",
                            "always_show": false,
                            "alternatives": [],
                            "style": []
                        },
                        "confused_answers": [
                            {
                                "label": "Cantonese",
                                "value": "櫃"
                            }
                        ],
                        "difficulty": "unknown"
                    },
                    {
                        "learnable_id": "1026544173571",
                        "thing_id": 15663821,
                        "item": {
                            "kind": "text",
                            "value": "to make",
                            "label": "English",
                            "always_show": false,
                            "alternatives": [],
                            "style": []
                        },
                        "definition": {
                            "kind": "text",
                            "value": "zou6",
                            "label": "Pronunciation",
                            "always_show": false,
                            "alternatives": [],
                            "style": []
                        },
                        "confused_answers": [
                            {
                                "label": "Cantonese",
                                "value": "造"
                            }
                        ],
                        "difficulty": "unknown"
                    },
                    {
                        "learnable_id": 2,
                        "item": {
                            "kind": "text",
                            "value": "table",
                            "label": "English",
                            "alternatives": [],
                        },
                        "definition": {
                            "kind": "text",
                            "value": "toi2",
                            "label": "Pronunciation",
                            "alternatives": [],
                        },
                        "confused_answers": [
                            {
                                "label": "Cantonese",
                                "value": "檯"
                            }
                        ],
                        "difficulty": "unknown"
                    },
                    {
                        "learnable_id": "1026546991619",
                        "thing_id": 15663864,
                        "item": {
                            "kind": "text",
                            "value": "to think",
                            "label": "English",
                            "always_show": false,
                            "alternatives": [],
                            "style": []
                        },
                        "definition": {
                            "kind": "text",
                            "value": "lam2",
                            "label": "Pronunciation",
                            "always_show": false,
                            "alternatives": [],
                            "style": []
                        },
                        "confused_answers": [
                            {
                                "label": "Cantonese",
                                "value": "諗"
                            }
                        ],
                        "difficulty": "unknown"
                    },
                    {
                        "learnable_id": "1026545746435",
                        "thing_id": 15663845,
                        "item": {
                            "kind": "text",
                            "value": "chair",
                            "label": "English",
                            "always_show": false,
                            "alternatives": [],
                            "style": []
                        },
                        "definition": {
                            "kind": "text",
                            "value": "dang3",
                            "label": "Pronunciation",
                            "always_show": false,
                            "alternatives": [],
                            "style": []
                        },
                        "confused_answers": [
                            {
                                "label": "Cantonese",
                                "value": "凳"
                            }
                        ],
                        "difficulty": "unknown"
                    },
                    {
                        "learnable_id": "1026545811971",
                        "thing_id": 15663846,
                        "item": {
                            "kind": "text",
                            "value": "bed",
                            "label": "English",
                            "always_show": false,
                            "alternatives": [],
                            "style": []
                        },
                        "definition": {
                            "kind": "text",
                            "value": "cong4",
                            "label": "Pronunciation",
                            "always_show": false,
                            "alternatives": [],
                            "style": []
                        },
                        "confused_answers": [
                            {
                                "label": "Cantonese",
                                "value": "床"
                            }
                        ],
                        "difficulty": "unknown"
                    },
                    {
                        "learnable_id": "1027155689987",
                        "thing_id": 15673152,
                        "item": {
                            "kind": "text",
                            "value": "who",
                            "label": "English",
                            "always_show": false,
                            "alternatives": [],
                            "style": []
                        },
                        "definition": {
                            "kind": "text",
                            "value": "bin1 go3",
                            "label": "Pronunciation",
                            "always_show": false,
                            "alternatives": [],
                            "style": []
                        },
                        "confused_answers": [
                            {
                                "label": "Cantonese",
                                "value": "邊個"
                            }
                        ],
                        "difficulty": "unknown"
                    },
                    {
                        "learnable_id": "1026546074115",
                        "thing_id": 15663850,
                        "item": {
                            "kind": "text",
                            "value": "pillow",
                            "label": "English",
                            "always_show": false,
                            "alternatives": [],
                            "style": []
                        },
                        "definition": {
                            "kind": "text",
                            "value": "zam2 tau4",
                            "label": "Pronunciation",
                            "always_show": false,
                            "alternatives": [],
                            "style": []
                        },
                        "confused_answers": [
                            {
                                "label": "Cantonese",
                                "value": "枕頭"
                            }
                        ],
                        "difficulty": "unknown"
                    },
                    {
                        "learnable_id": "1027146383875",
                        "thing_id": 15673010,
                        "item": {
                            "kind": "text",
                            "value": "how",
                            "label": "English",
                            "always_show": false,
                            "alternatives": [],
                            "style": []
                        },
                        "definition": {
                            "kind": "text",
                            "value": "dim2 joeng2",
                            "label": "Pronunciation",
                            "always_show": false,
                            "alternatives": [],
                            "style": []
                        },
                        "confused_answers": [
                            {
                                "label": "Cantonese",
                                "value": "點樣"
                            }
                        ],
                        "difficulty": "unknown"
                    },
                    {
                        "learnable_id": "1026546336259",
                        "thing_id": 15663854,
                        "item": {
                            "kind": "text",
                            "value": "iron",
                            "label": "English",
                            "always_show": false,
                            "alternatives": [],
                            "style": []
                        },
                        "definition": {
                            "kind": "text",
                            "value": "tong3 dau2",
                            "label": "Pronunciation",
                            "always_show": false,
                            "alternatives": [],
                            "style": []
                        },
                        "confused_answers": [
                            {
                                "label": "Cantonese",
                                "value": "燙斗"
                            }
                        ],
                        "difficulty": "unknown"
                    }
                ],
                screens: [
                    {
                        "presentation": {
                            "item": {
                                "label": "English",
                                "kind": "text",
                                "value": "table",
                                "alternatives": [],
                                "style": [],
                                "direction": "target",
                                "markdown": false
                            },
                            "definition": {
                                "label": "Pronunciation",
                                "kind": "text",
                                "value": "toi2",
                                "alternatives": [],
                                "style": [],
                                "direction": "source",
                                "markdown": false
                            },
                            "visible_info": [],
                            "hidden_info": [
                                {
                                    "label": "Cantonese",
                                    "kind": "text",
                                    "value": "檯",
                                    "alternatives": [],
                                    "style": [
                                        "bigger"
                                    ],
                                    "direction": "target",
                                    "markdown": false
                                }
                            ],
                            "attributes": [],
                            "audio": {
                                "label": "Audio",
                                "kind": "audio",
                                "value": [
                                    {
                                        "normal": "https://static.memrise.com/uploads/things/audio/15663841_1367278110906.mp3",
                                        "slow": null
                                    }
                                ],
                                "alternatives": [],
                                "style": [],
                                "direction": "target",
                                "markdown": false
                            },
                            "markdown": false,
                            "template": "presentation"
                        },
                        "multiple_choice": {
                            "template": "multiple_choice",
                            "prompt": {
                                "text": {
                                    "label": "Pronunciation",
                                    "kind": "text",
                                    "value": "toi2",
                                    "alternatives": [],
                                    "style": [],
                                    "direction": "source",
                                    "markdown": false
                                },
                                "audio": {
                                    "label": "Audio",
                                    "kind": "audio",
                                    "value": [
                                        {
                                            "normal": "https://static.memrise.com/uploads/things/audio/15663841_1367278110906.mp3",
                                            "slow": null
                                        }
                                    ],
                                    "alternatives": [],
                                    "style": [],
                                    "direction": "target",
                                    "markdown": false
                                },
                                "video": null,
                                "image": null
                            },
                            "answer": {
                                "label": "English",
                                "kind": "text",
                                "value": "table",
                                "alternatives": [],
                                "style": [],
                                "direction": "target",
                                "markdown": false
                            },
                            "correct": [
                                "table"
                            ],
                            "choices": [
                                "taxi",
                                "head",
                                "to look",
                                "to make",
                                "sky",
                                "Thursday",
                                "MTR",
                                "Tomorrow I go to the airport.",
                                "to go",
                                "tiger",
                                "to walk",
                                "day after tomorrow"
                            ],
                            "audio": {
                                "label": "Audio",
                                "kind": "audio",
                                "value": [
                                    {
                                        "normal": "https://static.memrise.com/uploads/things/audio/15663841_1367278110906.mp3",
                                        "slow": null
                                    }
                                ],
                                "alternatives": [],
                                "style": [],
                                "direction": "target",
                                "markdown": false
                            },
                            "attributes": [],
                            "post_answer_info": null,
                            "placeholder": null,
                            "feedback_screen": null,
                            "is_strict": false,
                            "translation_prompt": null,
                            "gap_prompt": null
                        },
                        "reversed_multiple_choice": {
                            "template": "reversed_multiple_choice",
                            "prompt": {
                                "text": {
                                    "label": "English",
                                    "kind": "text",
                                    "value": "table",
                                    "alternatives": [],
                                    "style": [],
                                    "direction": "target",
                                    "markdown": false
                                },
                                "audio": {
                                    "label": "Audio",
                                    "kind": "audio",
                                    "value": [
                                        {
                                            "normal": "https://static.memrise.com/uploads/things/audio/15663841_1367278110906.mp3",
                                            "slow": null
                                        }
                                    ],
                                    "alternatives": [],
                                    "style": [],
                                    "direction": "target",
                                    "markdown": false
                                },
                                "video": null,
                                "image": null
                            },
                            "answer": {
                                "label": "Pronunciation",
                                "kind": "text",
                                "value": "toi2",
                                "alternatives": [],
                                "style": [],
                                "direction": "source",
                                "markdown": false
                            },
                            "correct": [
                                "toi2"
                            ],
                            "choices": [
                                "lam2",
                                "heoi3",
                                "wan2",
                                "leoi5 jau4 ce1",
                                "tong3 dau2",
                                "tai2",
                                "haang4",
                                "si4 gaan3",
                                "hou2 gou1 hing3 sik1 dak1 nei5",
                                "hau6 jat6",
                                "fo2 ce1",
                                "ngo5 ting1 jat6 heoi3 gei1 coeng4"
                            ],
                            "audio": {
                                "label": "Audio",
                                "kind": "audio",
                                "value": [
                                    {
                                        "normal": "https://static.memrise.com/uploads/things/audio/15663841_1367278110906.mp3",
                                        "slow": null
                                    }
                                ],
                                "alternatives": [],
                                "style": [],
                                "direction": "target",
                                "markdown": false
                            },
                            "attributes": [],
                            "post_answer_info": null,
                            "placeholder": null,
                            "feedback_screen": null,
                            "is_strict": false,
                            "translation_prompt": null,
                            "gap_prompt": null
                        },
                        "typing": {
                            "template": "typing",
                            "prompt": {
                                "text": {
                                    "label": "Pronunciation",
                                    "kind": "text",
                                    "value": "toi2",
                                    "alternatives": [],
                                    "style": [],
                                    "direction": "source",
                                    "markdown": false
                                },
                                "audio": {
                                    "label": "Audio",
                                    "kind": "audio",
                                    "value": [
                                        {
                                            "normal": "https://static.memrise.com/uploads/things/audio/15663841_1367278110906.mp3",
                                            "slow": null
                                        }
                                    ],
                                    "alternatives": [],
                                    "style": [],
                                    "direction": "target",
                                    "markdown": false
                                },
                                "video": null,
                                "image": null
                            },
                            "answer": {
                                "label": "English",
                                "kind": "text",
                                "value": "table",
                                "alternatives": [],
                                "style": [],
                                "direction": "target",
                                "markdown": false
                            },
                            "correct": [
                                "table"
                            ],
                            "choices": [
                                "b",
                                "w",
                                "t",
                                "a",
                                "e",
                                "l",
                                ".",
                                "o"
                            ],
                            "audio": {
                                "label": "Audio",
                                "kind": "audio",
                                "value": [
                                    {
                                        "normal": "https://static.memrise.com/uploads/things/audio/15663841_1367278110906.mp3",
                                        "slow": null
                                    }
                                ],
                                "alternatives": [],
                                "style": [],
                                "direction": "target",
                                "markdown": false
                            },
                            "attributes": [],
                            "post_answer_info": null,
                            "placeholder": null,
                            "feedback_screen": null,
                            "is_strict": false,
                            "translation_prompt": null,
                            "gap_prompt": null
                        }
                    },
                ],
                stats: [
                    {
                        question: '',
                        type: '',
                        percent_learnt: 0
                    },
                    {
                        question: '',
                        type: '',
                        percent_learnt: 0
                    },
                    {
                        question: '',
                        type: '',
                        percent_learnt: 0
                    },
                    {
                        question: '',
                        type: '',
                        percent_learnt: 0
                    },
                    {
                        question: '',
                        type: '',
                        percent_learnt: 0
                    },
                    {
                        question: '',
                        type: '',
                        percent_learnt: 0
                    },
                    {
                        question: '',
                        type: '',
                        percent_learnt: 0
                    },
                    {
                        question: '',
                        type: '',
                        percent_learnt: 0
                    },
                    {
                        question: '',
                        type: '',
                        percent_learnt: 0
                    },
                    {
                        question: '',
                        type: '',
                        percent_learnt: 0
                    }
                    ],
                current_percent: 0

            }
        },
        computed: {
            question() {
                if (this.next.type === "multiple_choice") {
                    return this.screens[this.next.index].multiple_choice;
                } else if (this.next.type === "presentation") {
                    return this.screens[this.next.index].presentation;
                } else if (this.next.type === "reversed_multiple_choice") {
                    return this.screens[this.next.index].reversed_multiple_choice;
                } else if (this.next.type === "typed_question") {
                    return this.screens[this.next.index].typing;
                }
            }
        },
        methods: {
            LoadNextQuestion: function(correctAnswer) {
                console.log(correctAnswer);
                this.next.type= "reversed_multiple_choice";

                this.stats.forEach((element, index) => {
                    if(element.percent_learnt<= this.current_percent){
                    console.log(index);
                    //this.next.index = index
                        return
                    }
                });
                this.current_percent += 10
            }
        }
    }
</script>

<style>
    .quiz_index{
        background-color: #F5F5F5;
    }
</style>