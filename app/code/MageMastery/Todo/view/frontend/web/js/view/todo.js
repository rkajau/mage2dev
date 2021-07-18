define([
    'uiComponent',
    'jquery',
    'Magento_Ui/js/modal/confirm',
    'MageMastery_Todo/js/service/task',
    'MageMastery_Todo/js/model/loader',
], function (Component, $, modal, taskService, loader) {
    'use strict';

    return Component.extend({
        defaults: {
            newTaskLabel: '',
            buttonSelector: '#add-new-task-button',
            tasks: [
                {id: 1, label: "Task 1", status: false},
                {id: 2, label: "Task 2", status: false},
                {id: 3, label: "Task 3", status: false},
                {id: 4, label: "Task 4", status: true},
            ],
            secondTasksList: null
        },

        initObservable: function() {
            this._super().observe(['tasks', 'newTaskLabel']);

            var self = this;
            taskService.getList().then(function (tasks) {
                self.tasks(tasks);
                return tasks;
            });

            return this;
        },

        switchStatus: function (data, event) {
            const taskId = $(event.target).data('id');

            var items = this.tasks().map(function (task) {
                if (task.task_id === taskId) {
                    task.status = task.status === 'open' ? 'complete' : 'open';
                    taskService.update(taskId, task.status);
                }

                return task;
            });

            console.log(items);

            console.log(taskId);

            this.tasks(items);
        },

        deleteTask: function (taskId) {
            var self = this;

            modal({
                content: 'Delete item',
                actions: {
                    confirm: function () {
                        var tasks = [];

                        taskService.delete(self.tasks().find(function (task) {
                            if(task.task_id === taskId) {
                                return task;
                            }
                        }))

                        if (self.tasks().length === 1) {
                            self.tasks(tasks);
                            return;
                        }

                        self.tasks().forEach(function (task) {
                            if (task.task_id !== taskId) {
                                tasks.push(task);
                            }
                        });

                        self.tasks(tasks);
                    }
                }
            });
        },

        addTask: function () {
            const self = this;

            var task = {
                label: this.newTaskLabel(),
                status: 'open',
                customer_id: 1,
            };

            loader.startLoader();

            taskService.create(task)
                .then(function(taskId) {
                    task.task_id = taskId;
                    self.tasks.push(task);
                }).finally(function () {
                    loader.stopLoader();
            });
        },

        checkKey: function (data, event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                $(this.buttonSelector).click();
            }
        }
    });
});
