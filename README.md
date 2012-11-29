cheng
==============

css 任务发放中


成员列表
--------

- Lionel Dong

- 冥芽

- 助理炮仗引燃师

- zwhu

- guolirong

GitHub使用指南
--------------

你可以看到有两个 branch，一个 master，一个dev。在我（picasso250，即创建者）的账户里，master 是主分支，dev 是开发分支，对代码的修改都是先在 dev 里进行的，验证了之后，会 merge 到 master 里。也就是说，master 永远是最稳定的代码，dev是自己做实验，做开发的代码。

那么我推荐你们 forker 在本地开发中，所有的开发也在 dev下面进行，提 pull request 的时候，将 dev 分支提给我的 master 分支。这样，你们的 master 分支就没有用了，不需要管了。

**如何和我的代码保持一致：**

首先添加远端，这句只需要执行一次。

`git remote add upstream https://github.com/picasso250/cheng.git`

可以执行 `git remote -v` 确定远端添加成功。

然后从我的 master分支拉取代码：

`git pull upstream master`

如果提示冲突，请解决冲突，如果没有，那么就更好了。
