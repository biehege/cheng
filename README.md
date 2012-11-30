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

最基本的入门可以参考：

你可以看到有两个 branch，一个 master，一个dev。在我（picasso250，即创建者）的账户里，master 是主分支，dev 是开发分支。也就是说，master 永远是最稳定的代码，dev是自己做实验，做开发的代码。

你们（forker）提 pull request 的时候，推荐你们提给我的 dev 分支。

**如何和我的代码保持一致：**

因为所有人的代码都在修改，而这些修改最终都要输送到我的 master 里，所以，有时候你的代码会“过时”，那么这时候就需要同步代码。同步代码是通过 **pull** 操作进行的。

首先添加远端，这句只需要执行一次。

`git remote add upstream https://github.com/picasso250/cheng.git`

可以执行 `git remote -v` 确定远端添加成功。

然后从我的 master分支拉取代码：

`git pull upstream master`

如果提示冲突，请解决冲突，如果没有，那么就更好了。你的代码已经和最新的 master 代码保持一致了。
