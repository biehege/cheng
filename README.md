cheng
==============

<<<<<<< HEAD
css 任务发放

todo
======

- 订单号生成规则（不需要考虑性能）
=======
css 任务发放中

>>>>>>> d567773eb075a847b29841a464dbfe04f5aa24a4

成员列表
--------

- Lionel Dong

- 冥芽

- 助理炮仗引燃师

- zwhu

- guolirong

<<<<<<< HEAD
change by xiaochi
=======
GitHub使用指南
--------------

你可以看到有两个 branch，一个 master，一个dev。在我（picasso250，即创建者）的账户里，master 是主分支，dev 是开发分支，对代码的修改都是先在 dev 里进行的，验证了之后，会 merge 到 master 里。也就是说，master 永远是最稳定的代码，dev是自己做实验，做开发的代码。

那么我推荐你们（forker）的所有的开发也在你们的 dev下面进行，提 pull request 的时候，将你们的 dev 分支提给我的 master 分支。（你们的 master 分支就没有用了，不需要管了）

**如何和我的代码保持一致：**

因为所有人的 dev 代码都在修改，而这些修改最终都要输送到我的 master 里，所以，不可避免的，有时候你的代码会“过时”，那么这时候就需要同步代码。

首先添加远端，这句只需要执行一次。

`git remote add upstream https://github.com/picasso250/cheng.git`

可以执行 `git remote -v` 确定远端添加成功。

然后从我的 master分支拉取代码：

`git pull upstream master`

如果提示冲突，请解决冲突，如果没有，那么就更好了。你的代码已经和最新的 master 代码保持一致了。
>>>>>>> d567773eb075a847b29841a464dbfe04f5aa24a4

test